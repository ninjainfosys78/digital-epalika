<?php

namespace Modules\Identity\Http\Controllers;

use App\Enums\Gender;
use App\Models\Settings\FiscalYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Modules\Identity\Entities\DisabilityIdentityCard;
use Modules\Identity\Entities\DisabilityType;
use Modules\Identity\Entities\GovernmentalDisabilityType;

class DisabilityIdentityCardReportController extends Controller
{
    public function report()
    {
        $governmentalDisabilityTypes = GovernmentalDisabilityType::orderBy('position')->get();
        $disabilityTypes = DisabilityType::with('disabilityIdentityCards')->get()->map(function ($disabilityType) use ($governmentalDisabilityTypes) {
            $cardData = collect();
            //push by types
            foreach ($governmentalDisabilityTypes as $governmentalDisabilityType) {
                $cardData->push([
                    'male' => $disabilityType->disabilityIdentityCards->where('govern_disability_type_id', $governmentalDisabilityType->id)->where('gender', Gender::MALE)->count(),
                    'female' => $disabilityType->disabilityIdentityCards->where('govern_disability_type_id', $governmentalDisabilityType->id)->where('gender', Gender::FEMALE)->count(),
                    'other' => $disabilityType->disabilityIdentityCards->where('govern_disability_type_id', $governmentalDisabilityType->id)->where('gender', Gender::OTHER)->count(),
                    'total' => $disabilityType->disabilityIdentityCards->where('govern_disability_type_id', $governmentalDisabilityType->id)->count()
                ]);
            }
            //push with sum
            $cardData->push([
                'male' => $disabilityType->disabilityIdentityCards->where('gender', Gender::MALE)->count(),
                'female' => $disabilityType->disabilityIdentityCards->where('gender', Gender::FEMALE)->count(),
                'other' => $disabilityType->disabilityIdentityCards->where('gender', Gender::OTHER)->count(),
                'total' => $disabilityType->disabilityIdentityCards->count()
            ]);
            $disabilityType->cardsCount = $cardData;
            return $disabilityType;
        });

        return view('identity::admin.report.disabilityIdentityCardReport', compact('disabilityTypes', 'governmentalDisabilityTypes'));
    }

    public function wardWise()
    {
        $fiscalYears = FiscalYear::all();
        return view('identity::admin.report.wardWise', compact('fiscalYears'));
    }

    public function wardWiseReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
        ]);

        $disabilityIdentityCards = DisabilityIdentityCard::where(function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        })->get();

        $wardData = [];
        foreach (officeSetting()->localBody->ward_no as $ward_no) {
            $wardData[] = $disabilityIdentityCards->where('permanent_ward', $ward_no)->count();
        }

        return response()->json([
            'view' => (string)View::make('identity::admin.report.inc.ward', compact('wardData', 'disabilityIdentityCards'))
        ]);
    }

    private function filterDataFromUser($q, Request $request): void
    {
        if (!empty($request->input('fiscal_year'))) {
            $q->whereIn('fiscal_year_id', $request->input('fiscal_year'));
        }

        //        if (!empty($request->input('from_date'))) {
        //            $q->whereDate('registration_date_ne', '>=', $request->input('from_date'));
        //        }
        //
        //        if (!empty($request->input('to_date'))) {
        //            $q->whereDate('registration_date_ne', '<=', $request->input('to_date'));
        //        }
        //
        //        if (!empty($request->input('object_transaction'))) {
        //            $q->whereIn('object_transaction_id', $request->input('object_transaction'));
        //        }
        //
        //        if (!empty($request->input('business_nature'))) {
        //            $q->whereIn('business_nature_id', $request->input('business_nature'));
        //        }
        //        if (!empty($request->input('ward_no'))) {
        //            $q->whereIn('ward_no', $request->input('ward_no'));
        //        }
    }

    public function governmentalDisabilityType()
    {
        $fiscalYears = FiscalYear::all();
        $governmentalDisabilityTypes = GovernmentalDisabilityType::all();
        return view('identity::admin.report.governmentalDisabilityType', compact('fiscalYears', 'governmentalDisabilityTypes'));
    }

    public function governmentalDisabilityTypeReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'governmentalDisabilityType' => ['nullable', 'array'],
            'governmentalDisabilityType.*' => [Rule::exists('governmental_disability_types', 'id')],
        ]);

        $governmentalDisabilityTypes = GovernmentalDisabilityType::with(['disabilityIdentityCards' => function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        }])
            ->where(function ($query) use ($request) {
                if (!empty($request->input('governmentalDisabilityType'))) {
                    $query->whereIn('id', $request->input('governmentalDisabilityType'));
                }
            })
            ->get()->map(function ($governmentalDisabilityType) {
                $wardData = [];
                foreach (officeSetting()->localBody->ward_no as $ward_no) {
                    $wardData[] = $governmentalDisabilityType->disabilityIdentityCards->where('permanent_ward', $ward_no)->count();
                }
                return [
                    'title' => $governmentalDisabilityType->title,
                    'wards' => $wardData,
                    'total' => $governmentalDisabilityType->disabilityIdentityCards->count()
                ];
            });
        return response()->json([
            'total' => $governmentalDisabilityTypes->sum('total'),
            'fiscal_years' => !empty($request->input('fiscal_year')) ? FiscalYear::select('title')->whereIn('id', Arr::wrap($request->input('fiscal_year')))->pluck('title') : FiscalYear::pluck('title'),
            'view' => (string)View::make('identity::admin.report.inc.governmentalDisability', compact('governmentalDisabilityTypes'))
        ]);
    }

    public function disabilityType()
    {
        $fiscalYears = FiscalYear::all();
        $disabilityTypes = DisabilityType::all();
        return view('identity::admin.report.disabilityType', compact('fiscalYears', 'disabilityTypes'));
    }

    public function disabilityTypeReport(Request $request)
    {
        $request->validate([
            'from_date' => ['nullable'],
            'to_date' => ['nullable'],
            'fiscal_year' => ['nullable', 'array'],
            'fiscal_year.*' => [Rule::exists('fiscal_years', 'id')],
            'disabilityType' => ['nullable', 'array'],
            'disabilityType.*' => [Rule::exists('disability_types', 'id')],
        ]);

        $disabilityTypes = DisabilityType::with(['disabilityIdentityCards' => function ($query) use ($request) {
            $this->filterDataFromUser($query, $request);
        }])
            ->where(function ($query) use ($request) {
                if (!empty($request->input('disabilityType'))) {
                    $query->whereIn('id', $request->input('disabilityType'));
                }
            })
            ->get()->map(function ($disabilityType) {
                $wardData = [];
                foreach (officeSetting()->localBody->ward_no as $ward_no) {
                    $wardData[] = $disabilityType->disabilityIdentityCards->where('permanent_ward', $ward_no)->count();
                }
                return [
                    'title' => $disabilityType->title,
                    'wards' => $wardData,
                    'total' => $disabilityType->disabilityIdentityCards->count()
                ];
            });
        return response()->json([
            'total' => $disabilityTypes->sum('total'),
            'fiscal_years' => !empty($request->input('fiscal_year')) ? FiscalYear::select('title')->whereIn('id', Arr::wrap($request->input('fiscal_year')))->pluck('title') : FiscalYear::pluck('title'),
            'view' => (string)View::make('identity::admin.report.inc.disabilityType', compact('disabilityTypes'))
        ]);
    }
}
