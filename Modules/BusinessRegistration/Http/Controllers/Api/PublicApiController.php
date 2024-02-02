<?php

namespace Modules\BusinessRegistration\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\BusinessRegistration\Entities\BusinessNature;
use Modules\BusinessRegistration\Entities\ObjectTransaction;
use Modules\BusinessRegistration\Enums\Qualification;
use Modules\BusinessRegistration\Http\Requests\BusinessRegistration\StoreBusinessRegistrationFormRequest;
use App\Models\Settings\OfficeSetting;
use Modules\BusinessRegistration\Entities\BusinessDetail;
use Illuminate\Support\Facades\DB;
use Modules\BusinessRegistration\Transformers\BusinessRegistrationResource;

class PublicApiController extends Controller
{
    public function businessRegistrationSetting()
    {
        return [
            'businessNatures' => BusinessNature::selectRaw('id,title')->get(),
            'objectTransactions' => ObjectTransaction::selectRaw('id,title')->get(),
            'qualifications' => Qualification::getValuesWithLabels(),
            'allDistricts' => get_districts(),

        ];
    }

    public function businessRegistration(StoreBusinessRegistrationFormRequest $request)
    {
        $data = DB::transaction(function () use ($request) {

            $businessRegistration = BusinessDetail::create($request->validated() + [
                'fiscal_year_id' => OfficeSetting::first()->fiscal_year_id,
                'mobile_user_id' => auth()->id(),
                'submission_no' => time(),
            ]);


            if(!empty($request->validated()['partners'])) {
                foreach ($request->validated()['partners'] as $partner) {

                    $businessRegistration->partners()->create($partner);
                }
            }

            if(!empty($request->validated()['registeredBusinesses'])) {
                foreach ($request->validated()['registeredBusinesses'] as $registeredBusiness) {

                    $businessRegistration->registeredBusinesses()->create($registeredBusiness);
                }
            }

            if(!empty($request->validated()['other_document'])) {
                foreach ($request->validated['other_document'] ?? [] as $document) {
                    $businessRegistration->files()->create([
                        'file_name' => pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME),
                        'extension' => $document->getClientOriginalExtension(),
                        'file' => $document->store('otherDocument/', 'public')
                    ]);
                }
            }




            return $businessRegistration;
        });

        return response()->json([
            'message' => 'Business Registered Successfully'
        ], 201);
    }

    public function registeredBusiness()
    {
        return BusinessRegistrationResource::collection(auth()->user()?->load(['businessDetails.objectTransaction', 'businessDetails.businessNature'])?->businessDetails);
    }
}
