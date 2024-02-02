<?php

namespace Modules\Identity\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Ethnicity;
use App\Models\Occupation;
use App\Models\Settings\Relationship;
use App\Traits\NepaliDateConverter;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Modules\Identity\Entities\DisabilityIdentityCard;
use Modules\Identity\Entities\DisabilityPrint;
use Modules\Identity\Entities\DisabilityReason;
use Modules\Identity\Entities\DisabilityType;
use Modules\Identity\Entities\Hospital;
use Modules\Identity\Entities\RecommendationTemplateSetting;
use Modules\Identity\Http\Requests\DisabilityIdentityCard\StoreDisabilityIdentityCardRequest;
use Modules\Identity\Http\Requests\DisabilityIdentityCard\UpdateDisabilityIdentityCardRequest;

class DisabilityIdentityCardController extends Controller
{
    use NepaliDateConverter;

    public function index()
    {
        $recommendationTemplateSetting = recommendationTemplateSettingData();

        $disabilityIdentityCards = DisabilityIdentityCard::with('disabilityType')
            ->where(function ($q) {
                if (!is_null(request('search'))) {
                    $q->whereLike([
                        'name',
                        'name_en',
                        'citizenship_no',
                        'birth_registration_no',
                        'guardian_name',
                        'guardian_name_en',
                        'phone'
                    ], request('search'));
                }
            })
            ->orWhere(function ($q) use ($recommendationTemplateSetting) {
                if ($recommendationTemplateSetting?->is_hospital_detail_required) {
                    $q->where('status', StatusEnum::PENDING->value);
                } else {
                    $q->where('status', StatusEnum::ELIGIBILITY_FOR_MEETING->value);
                }
            })
            ->latest()
            ->paginate(10);
        $hospitals = Hospital::all();

        return view('identity::admin.disabilityIdentityCard.index', compact('hospitals', 'disabilityIdentityCards', 'recommendationTemplateSetting', ));
    }

    public function create()
    {
        $officeSetting = officeSetting();
        $ethnicities = Ethnicity::all();
        $relations = Relationship::all();
        $disabilityTypes = DisabilityType::all();
        $todayDateInBS = $this->get_today_nepali_date();
        $disabilityReasons = DisabilityReason::all();
        $occupations = Occupation::all();

        return view('identity::admin.disabilityIdentityCard.create', compact('officeSetting', 'ethnicities', 'relations', 'disabilityTypes', 'todayDateInBS', 'disabilityReasons', 'occupations'));
    }

    public function store(StoreDisabilityIdentityCardRequest $request)
    {
        DB::transaction(function () use ($request) {
            $recommendationTemplateSetting = RecommendationTemplateSetting::first();
            $disabilityIdentityCard = DisabilityIdentityCard::create($request->validated() + [
                    'status' => ($request->boolean('is_full_detail_required')
                        || !$recommendationTemplateSetting?->is_hospital_detail_required)
                        ? StatusEnum::ELIGIBILITY_FOR_MEETING->value
                        : StatusEnum::PENDING->value,
                    'fiscal_year_id' => officeSetting()->fiscal_year_id ?? null,
                ]);

            if ($disabilityIdentityCard->is_full_detail_required) {
                $disabilityIdentityCard->update($request->validated()['fullDetail']);
            }
        });

        toast('अपाङ्गता परिचय पत्र सफलतापुर्बक दर्ता भयो', 'success');
        return back();
    }

    public function searchCitizenshipNo()
    {
        return view('identity::admin.disabilityIdentityCard.citizenship_search');
    }


    public function show(DisabilityIdentityCard $disabilityIdentityCard)
    {
        $this->authorize('view', $disabilityIdentityCard);
        $officeHeaders = get_office_header();
        $todayDate = $this->get_today_nepali_date();
        $disabilityIdentityCard->load('province', 'district', 'disabilityType', 'localBody', 'relationship');
        return view('identity::admin.disabilityIdentityCard.show', compact('disabilityIdentityCard', 'officeHeaders', 'todayDate'));
    }

    public function edit(DisabilityIdentityCard $disabilityIdentityCard)
    {
        $this->authorize('update', $disabilityIdentityCard);
        $officeSetting = officeSetting();
        $ethnicities = Ethnicity::all();
        $relations = Relationship::all();
        $disabilityTypes = DisabilityType::all();
        $todayDateInBS = $this->get_today_nepali_date();
        $disabilityReasons = DisabilityReason::all();
        $occupations = Occupation::all();
        return view('identity::admin.disabilityIdentityCard.edit', compact('disabilityIdentityCard', 'ethnicities', 'relations', 'disabilityTypes', 'todayDateInBS', 'officeSetting', 'disabilityReasons', 'occupations'));
    }

    public function update(UpdateDisabilityIdentityCardRequest $request, DisabilityIdentityCard $disabilityIdentityCard)
    {
        $this->authorize('update', $disabilityIdentityCard);
        $recommendationTemplateSetting = recommendationTemplateSettingData();

        $extraFields = [
            'status' => ($request->boolean('is_full_detail_required')
                || !$recommendationTemplateSetting?->is_hospital_detail_required)
                ? StatusEnum::ELIGIBILITY_FOR_MEETING->value
                : StatusEnum::PENDING->value,
        ];

        if ($disabilityIdentityCard->is_full_detail_required) {
            $extraFields = array_merge($extraFields, $request->validated()['fullDetail']);
        }

        $disabilityIdentityCard->update($request->validated() + $extraFields);


        toast('अपाङ्गता परिचय पत्र सफलतापुर्बक अपडेट भयो', 'success');
        return redirect(route('identity.admin.disabilityIdentityCard.index'));
    }


    public function destroy(DisabilityIdentityCard $disabilityIdentityCard)
    {
        $this->authorize('delete', $disabilityIdentityCard);
        $disabilityIdentityCard->delete();

        return back();
    }

    public function printDetail(DisabilityIdentityCard $disabilityIdentityCard)
    {

        return view(
            'identity::admin.disabilityIdentityCard.printDetail',
            compact('disabilityIdentityCard')
        );
    }

    public function printData(Request $request, DisabilityIdentityCard $disabilityIdentityCard)
    {
        $request->validate([
            'hospital_id' => 'required',
            'date' => 'required'
        ]);
        $disabilityIdentityCard->update([
            'hospital_id' => $request->input('hospital_id'),
            'recommend_at' => now()
        ]);

        $data = $disabilityIdentityCard->getIdentityTemplateData(RecommendationTemplateSetting::first());
        $data = str_replace('[@today_date]', get_nepali_number($request->input('date')), $data);
        $view = (string)View::make(
            'identity::admin.disabilityIdentityCard.inc.print',
            compact('data')
        );
        return response()->json([
            'view' => $view,
        ]);
    }


    public function reportData(Request $request, DisabilityIdentityCard $disabilityIdentityCard)
    {

        $request->validate([
            'doctor_name' => 'required',
            'identity_no' => 'required'
        ]);
        $disabilityIdentityCard->update([
            'status' => StatusEnum::ELIGIBILITY_FOR_MEETING->value,
            'doctor_name' => $request->input('doctor_name'),
            'identity_no' => $request->input('identity_no'),
        ]);
        return response()->json([
            'message' => 'Report Data Added Successfully',
        ]);
    }

    public function printAll(DisabilityIdentityCard $disabilityIdentityCard)
    {

        $printData = DisabilityPrint::where('disability_identity_card_id', $disabilityIdentityCard->id)
            ->get()
            ->map(function ($disabilityPrint, $key) {
                $dateTime = new DateTime($disabilityPrint->date_ad);
                $time = $dateTime->format('H:i:s');
                return [
                    'id' => (int)$key + 1,
                    'title' => $disabilityPrint->title,
                    'date' => $disabilityPrint->date,
                    'time' => $time,
                ];
            });
        return response($printData);
    }
}
