<?php

namespace Modules\BusinessRegistration\Http\Controllers\Admin;

use App\Models\Settings\FiscalYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Modules\BusinessRegistration\Entities\BusinessDetail;
use Modules\BusinessRegistration\Entities\BusinessNature;
use Modules\BusinessRegistration\Entities\ObjectTransaction;
use Modules\BusinessRegistration\Transformers\Report\BusinessDetailResource;

class ReportController extends Controller
{
    public function index()
    {
        $fiscalYears = FiscalYear::all();
        $objectTransactions = ObjectTransaction::with('objectTransactions')->whereNull('object_transaction_id')->get();
        $businessNatures = BusinessNature::all();
        $columnData = $this->getColumns();
        return view('businessregistration::admin.report.index', compact('fiscalYears', 'columnData', 'businessNatures', 'objectTransactions'));
    }

    public function report(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable', 'after_or_equal:from_date'],
            'columns' => ['nullable', 'array']
        ]);

        if (empty($request->input('columns'))) {
            $request->request->add(
                ['columns' =>
                    [
                        'business_details' => ['name', 'registration_no', 'registration_date_ne', 'business_nature_id']
                    ]
                ]
            );
        }

        $projects = BusinessDetail::with('fiscalYear', 'province', 'localBody', 'district', 'businessNature', 'objectTransaction')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->whereNotNull('registration_no')->get();

        if (!empty($request->input('columns')['partners'])) {
            $projects->load(['partners' => function ($q) {
                $q->with('province', 'localBody', 'district', 'issueDistrict');
            }]);
        }

        if (!empty($request->input('columns')['registered_businesses'])) {
            $projects->load('registeredBusinesses');
        }

        if (!empty($request->input('columns')['business_renews'])) {
            $projects->load(['businessRenew' => function ($q) {
                $q->with('fiscalYear');
            }]);
        }

        return response()->json([
            'data' => BusinessDetailResource::collection($projects)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new BusinessDetail())
            ->ownAndRelatedModelsFillableColumns()
            ->filter(function ($column) {
                return !array_keys($column, 'printedData');
            })
            ->each(function ($column) use ($columnData) {
                $columnData->push(collect($column)->put('columns', $column['columns']));
            });
        return $columnData;
    }

    private function filterDataFromUser($q, Request $request): void
    {
        if (!empty($request->input('fiscal_year'))) {
            $q->whereIn('fiscal_year_id', $request->input('fiscal_year'));
        }

        if (!empty($request->input('from_date'))) {
            $q->whereDate('registration_date_ne', '>=', $request->input('from_date'));
        }

        if (!empty($request->input('to_date'))) {
            $q->whereDate('registration_date_ne', '<=', $request->input('to_date'));
        }

        if (!empty($request->input('object_transaction'))) {
            $q->whereIn('object_transaction_id', $request->input('object_transaction'));
        }

        if (!empty($request->input('business_nature'))) {
            $q->whereIn('business_nature_id', $request->input('business_nature'));
        }
        if (!empty($request->input('ward_no'))) {
            $q->whereIn('ward_no', $request->input('ward_no'));
        }
    }

    public function businessRegistrationBook()
    {
        $fiscalYears = FiscalYear::all();
        $objectTransactions = ObjectTransaction::with('objectTransactions')->whereNull('object_transaction_id')->get();
        $businessNatures = BusinessNature::all();
        return view('businessregistration::admin.report.business-registration-book', compact('businessNatures', 'objectTransactions', 'fiscalYears'));
    }

    public function businessRegistrationBookReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'ward_no' => ['nullable', 'array'],
            'object_transaction' => ['nullable', 'array'],
            'object_transaction.*' => [Rule::exists('object_transactions', 'id')],
            'business_nature' => ['nullable', 'array'],
            'business_nature.*' => [Rule::exists('business_natures', 'id')],
        ]);

        $businessDetails = BusinessDetail::with('partners', 'district', 'localBody', 'province', 'businessNature')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->whereNotNull('registration_no')->get()->map(function ($businessDetail, $key) {
            return [
                'sn' => (int)$key + 1,
                'registration_date' => $businessDetail->registration_date_ne,
                'registration_no' => $businessDetail->registration_no,
                'code' => $businessDetail->submission_no,
                'partner_name' => $businessDetail->partners?->first()?->name ?? '',
                'form_name' => $businessDetail->name ?? '',
                'address' => $businessDetail->address,
                'ward_no' => $businessDetail->ward_no,
                'phone' => $businessDetail->partners?->first()?->phone ?? '',
                'business_nature' => $businessDetail->businessNature->title ?? '',
                'is_rent' => $businessDetail->is_rent == 0 ? 'आफ्नो' : 'बहाल',
            ];
        });
        return response()->json([
            'data' => $businessDetails
        ]);
    }

    public function businessNatureWise()
    {
        $fiscalYears = FiscalYear::all();
        $businessNatures = BusinessNature::all();
        return view('businessregistration::admin.report.business-nature', compact('businessNatures', 'fiscalYears'));
    }

    public function businessNatureWiseReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'business_nature' => ['nullable', 'array'],
            'business_nature.*' => [Rule::exists('business_natures', 'id')],
        ]);

        $businessNatures = BusinessNature::with(['businessDetails' => function ($query) use ($request) {
            $query->whereNotNull('registration_no');
            $this->filterDataFromUser($query, $request);
        }])
            ->where(function ($query) use ($request) {
                if (!empty($request->input('business_nature'))) {
                    $query->whereIn('id', $request->input('business_nature'));
                }
            })
            ->get()->map(function ($businessNature) {
                $wardData = [];
                foreach (officeSetting()->localBody->ward_no as $ward_no) {
                    $wardData[] = $businessNature->businessDetails->where('ward_no', $ward_no)->count();
                }

                return [
                    'title' => $businessNature->title,
                    'wards' => $wardData,
                    'total' => $businessNature->businessDetails->count()
                ];
            });
        return response()->json([
            'total' => $businessNatures->sum('total'),
            'fiscal_years' => !empty($request->input('fiscal_year')) ? FiscalYear::select('title')->whereIn('id', Arr::wrap($request->input('fiscal_year')))->pluck('title') : FiscalYear::pluck('title'),
            'view' => (string)View::make('businessregistration::admin.report.inc.business_nature_table', compact('businessNatures'))
        ]);
    }

    public function objectTransaction()
    {
        $fiscalYears = FiscalYear::all();
        $objectTransactions = ObjectTransaction::whereNull('object_transaction_id')->get();
        return view('businessregistration::admin.report.object-transaction', compact('objectTransactions', 'fiscalYears'));
    }

    public function objectTransactionReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'object_transaction' => ['nullable', 'array'],
            'object_transaction.*' => [Rule::exists('object_transactions', 'id')],
        ]);

        $objectTransactions = ObjectTransaction::with(['objectTransactions.businessDetails', 'businessDetails' => function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
            $query->whereNotNull('registration_no');
        }])
            ->where(function ($query) use ($request) {
                if (!empty($request->input('object_transaction'))) {
                    $query->whereIn('id', $request->input('object_transaction'));
                }
            })->whereNull('object_transaction_id')
            ->get()->map(function ($objectTransaction) {
                $wardData = [];
                $total_count = $objectTransaction->businessDetails->count();
                foreach (officeSetting()->localBody->ward_no as $ward_no) {
                    $count = 0;
                    $sub_total_count = 0;
                    foreach ($objectTransaction->objectTransactions as $subObjectTransaction) {
                        $sub_total_count += $subObjectTransaction->businessDetails->where('ward_no', $ward_no)->count();
                        $count += $subObjectTransaction->businessDetails->where('ward_no', $ward_no)->count();
                    }
                    $total_count += $sub_total_count;
                    $wardData[] = $objectTransaction->businessDetails->where('ward_no', $ward_no)->count() + $count;
                }
                return [
                    'title' => $objectTransaction->title,
                    'wards' => $wardData,
                    'total' => $total_count
                ];
            });
        return response()->json([
            'fiscal_years' => FiscalYear::select('title')->whereIn('id', Arr::wrap($request->input('fiscal_year')))->get(),
            'view' => (string)View::make('businessregistration::admin.report.inc.object_transaction', compact('objectTransactions'))
        ]);
    }


    public function businessObjectTransactionNatureWise()
    {
        $fiscalYears = FiscalYear::all();
        $businessNatures = BusinessNature::all();
        $objectTransactions = ObjectTransaction::with('objectTransactions')->whereNull('object_transaction_id')->get();
        return view('businessregistration::admin.report.business-objectTransaction-nature-wise', compact('fiscalYears', 'objectTransactions', 'businessNatures'));
    }

    public function businessObjectTransactionNatureReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'object_transaction' => ['nullable', 'array'],
            'object_transaction.*' => [Rule::exists('object_transactions', 'id')],
            'business_nature' => ['nullable', 'array'],
            'business_nature.*' => [Rule::exists('business_natures', 'id')],
        ]);

        $businessDetails = BusinessDetail::where(function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        })->whereNotNull('registration_no')->get();

        $wardData = [];
        foreach (officeSetting()->localBody->ward_no as $ward_no) {
            $wardData[] = $businessDetails->where('ward_no', $ward_no)->count();
        }

        return response()->json([
            'fiscal_years' => FiscalYear::select('title')->whereIn('id', Arr::wrap($request->input('fiscal_year')))->get(),
            'wardsData' => $wardData
        ]);
    }

    public function wardWise()
    {
        $fiscalYears = FiscalYear::all();
        $businessNatures = BusinessNature::all();
        $objectTransactions = ObjectTransaction::with('objectTransactions')->whereNull('object_transaction_id')->get();
        return view('businessregistration::admin.report.ward-wise', compact('objectTransactions', 'fiscalYears', 'businessNatures'));
    }

    public function wardWiseReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'object_transaction' => ['nullable', 'array'],
            'object_transaction.*' => [Rule::exists('object_transactions', 'id')],
            'business_nature' => ['nullable', 'array'],
            'ward_no' => ['nullable', 'array'],
            'business_nature.*' => [Rule::exists('business_natures', 'id')],
        ]);

        $businessDetails = BusinessDetail::with('fiscalYear', 'partners', 'businessNature', 'objectTransaction', 'businessRenew.fiscalYear')->where(function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        })->whereNotNull('registration_no')->get()->map(function ($businessDetail, $key) {
            return [
                'sn' => (int)$key + 1,
                'partner_name' => $businessDetail->partners->first()?->name ?? '',
                'name' => $businessDetail->name,
                'address' => $businessDetail->address,
                'phone' => $businessDetail->partners->first()?->phone ?? '',
                'renew_fiscal_year' => $businessDetail->businessRenew->count() > 0 ? $businessDetail->businessRenew->first()?->fiscalYear->title ?? '' : $businessDetail->fiscalYear->title ?? '',
            ];
        });
        return response()->json([
            'data' => $businessDetails
        ]);
    }
}
