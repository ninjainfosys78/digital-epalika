<?php

namespace Modules\BusinessRegistration\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeHeader;
use App\Traits\NepaliDateConverter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\BusinessRegistration\Entities\BusinessDetail;
use Modules\BusinessRegistration\Entities\BusinessNature;
use Modules\BusinessRegistration\Entities\ObjectTransaction;
use Modules\BusinessRegistration\Entities\PrintedData;
use Modules\BusinessRegistration\Enums\TemplateTypeEnum;
use Modules\BusinessRegistration\Http\Requests\PrintedData\StorePrintedDataRequest;
use Illuminate\Database\Eloquent\Builder;

class BusinessRegistrationController extends Controller
{
    use NepaliDateConverter;

    public function index(): Factory|View|Application
    {
        $this->checkAuthorization('businessRegistration_access');
        $businessDetails = BusinessDetail::with('partners', 'partners.localBody', 'localBody', 'businessNature')->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['name', 'submission_no', 'registration_no'], request('search'));
            }
            if (!empty(request('object_transaction_id'))) {
                $q->where('object_transaction_id', request('object_transaction_id'));
            }
            if (!empty(request('business_nature_id'))) {
                $q->where('business_nature_id', request('business_nature_id'));
            }
            if (!empty(request('to_date'))) {
                $q->whereDate('registration_date_ne', '>=', request('to_date'));
            }
            if (!empty(request('from_date'))) {
                $q->whereDate('registration_date_ne', '<=', request('from_date'));
            }
            if (!empty(request('registration_no'))) {
                $q->where('registration_no', request('registration_no'));
            }
        })->latest()
            ->paginate(15);


        $objectTransactions = ObjectTransaction::with('objectTransactions')->whereNull('object_transaction_id')->get();
        $businessNatures = BusinessNature::all();

        return view('businessregistration::admin.businessRegistration.index', compact('businessDetails', 'objectTransactions', 'businessNatures'));
    }

    public function show(BusinessDetail $businessDetail): Factory|View|Application
    {
        $this->checkAuthorization('businessRegistration_access');

        $businessDetail->load(
            ['partners' => function ($query) {
                $query->with('issueDistrict', 'district', 'localBody');
            }, 'businessNature', 'registeredBusinesses']
        );

        return view('businessregistration::admin.businessRegistration.show', compact('businessDetail'));
    }

    public function customData(Request $request, BusinessDetail $businessDetail)
    {
        $this->checkAuthorization('customs_edit');

        $data = $request->validate([
            'bill_no' => ['required'],
            'bill_date_bs' => ['required'],
            'bill_date_ad' => ['required'],
            'other_file' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'amount' => ['required'],
            'taxpayer_number' => ['nullable'],
        ]);


        DB::transaction(function () use ($businessDetail, $data, $request) {
            if (empty($businessDetail->registration_no)) {
                $reg_no = BusinessDetail::whereFiscalYearId(\officeSetting()->fiscal_year_id)
                        ->max('reg_no') + 1;
                $data = array_merge($data, [
                    'reg_no' => $reg_no,
                    'fiscal_year_id' => \officeSetting()->fiscal_year_id,
                    'registration_no' => 'BR-' . officeSetting()->fiscalYear->title . '-' . Str::padLeft($reg_no, 4, 0),
                    'registration_date_en' => today()->toDateString(),
                    'registration_date_ne' => $this->get_today_nepali_date()
                ]);
            }

            $businessDetail->update($data);
        });
        toast('दस्तुर सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(BusinessDetail $businessDetail)
    {
        $businessDetail->load('partners', 'registeredBusinesses', 'files');

        return view('businessregistration::admin.businessRegistration.edit', compact('businessDetail'));
    }

    //    public function editData(BusinessDetail $businessDetail, TemplateTypeEnum $templateTypeEnum): Factory|View|Application
    //    {
    //        $this->checkAuthorization('businessRegistration_edit');
    //
    //        $businessDetail->load('printedData');
    //        $printed_data = $businessDetail->printedData
    //            ->where('for', $templateTypeEnum)
    //            ->sortByDesc('created_at')
    //            ->first();
    //        return view('businessregistration::admin.businessRegistration.edit', compact('businessDetail', 'templateTypeEnum', 'printed_data'));
    //    }

    public function storeData(StorePrintedDataRequest $request, BusinessDetail $businessDetail, $type): RedirectResponse
    {
        $this->checkAuthorization('businessRegistration_edit');
        DB::transaction(function () use ($request, $businessDetail, $type) {
            $printed_data = PrintedData::updateOrCreate(
                [
                    'business_detail_id' => $businessDetail->id,
                    'for' => $type,
                ],
                [
                    'data' => $request->input('data'),
                ]
            );

            if ($request->hasFile('files')) {
                $this->uploadDocuments($request, $printed_data);
            }
        });

        toast('फाइल सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    private function uploadDocuments($request, $printed_data): void
    {
        foreach ($request->validated()['files'] as $document) {
            $printed_data->files()->create([
                'file_name' => pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME),
                'extension' => $document->getClientOriginalExtension(),
                'file' => $document->store('PrintedFile', 'public'),
            ]);
        }
    }


    public function addData(BusinessDetail $businessDetail, TemplateTypeEnum $templateTypeEnum): Factory|View|Application
    {
        $this->checkAuthorization('customs_edit');
        return view('businessregistration::admin.businessRegistration.customs.index', compact('businessDetail', 'templateTypeEnum'));
    }


    public function print(BusinessDetail $businessDetail)
    {
        $officeHeaders = OfficeHeader::get();
        $businessDetail->load(
            ['partners' => function ($query) {
                $query->with('issueDistrict', 'district', 'localBody', 'province');
            }, 'businessNature', 'registeredBusinesses', 'province', 'district', 'localBody']
        );

        return view('businessregistration::admin.businessRegistration.print', compact('businessDetail', 'officeHeaders'));
    }
}
