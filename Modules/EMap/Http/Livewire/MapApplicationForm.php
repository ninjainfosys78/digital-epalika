<?php

namespace Modules\EMap\Http\Livewire;

use App\Models\Settings\OfficeSetting;
use App\Notifications\MapApplyNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\MapFee;
use Modules\EMap\Entities\LandUseArea;
use Modules\EMap\Entities\MapSetting;
use Modules\EMap\Entities\Organization;
use Modules\EMap\Entities\StructureType;

class MapApplicationForm extends Component
{
    use WithFileUploads;


    public $structureTypes = [];
    public $landUseAreas = [];

    public int $currentStep = 1;

    public bool $open_structure_type = false;

    public $allDistricts = [];

    public bool $same_as_land_owner = false;

    //    conversion
    public $conversion_units = [];

    public $conversion = [];

    public MapSetting $setting;

    public object $officeSetting;

    public $mapFees = [];

    public $organizations = [];

    public $convertedData = 0;

    public array $applyMap = [
        'application_type' => null,
        'construction_type' => null,
        'current_storey' => null,
        'future_storey' => null,
        'storeyDetails' => [],
        'consultant_signature' => null,
        'consultant_name' => null,
        'consultant_mobile_no' => null,
        'consultant_nec_no' => null,
        'organization_id' => null,
        'latitude' => null,
        'longitude' => null,
    ];

    public array $landDescription = [

        'ward_no' => null,
        'former_ward_no' => null,
        'tole' => null,
        'plot_no' => null,
        'unit_value' => 0,

    ];

    public array $landOwner = [
        'land_owner_type' => null,
        'name' => null,
        'phone' => null,
        'father_name' => null,
        'grandfather_name' => null,
        'citizenship_issue_district_id' => null,
        'citizenship_no' => null,
        'citizenship_issue_date' => null,
        'address' => null,
        'local_body' => null,
        'ward_no' => null,
    ];

    public array $houseOwner = [
        'name' => null,
        'phone' => null,
        'father_name' => null,
        'grandfather_name' => null,
        'citizenship_issue_district_id' => null,
        'citizenship_no' => null,
        'citizenship_issue_date' => null,
        'address' => null,
        'local_body' => null,
        'ward_no' => null,
    ];

    public array $applicantDetail = [
        'applicant_type' => null,
        'relation_with_owner' => null,
        'name' => null,
        'phone' => null,
        'father_name' => null,
        'citizenship_issue_district_id' => null,
        'citizenship_no' => null,
        'citizenship_issue_date' => null,
        'application_date' => null,
        'signature' => null,
    ];

    public function mount(): void
    {
        $this->setting = MapSetting::with('landMeasurement')->first() ?? new MapSetting();
        $this->organizations = Organization::with('userDetail', 'organizationDetail')->active()->get();
        $this->mapFees = MapFee::with('unit')->get();
        $this->landUseAreas = LandUseArea::get();
        $this->officeSetting = OfficeSetting::with('localBody')->first();

        if (empty($this->setting->land_measurement_id)) {
            $this->dispatchBrowserEvent('alert_message', [
                'type' => 'error',
                'title' => 'माफ गर्नुहोस्',
                'text' => 'मापन एकाइ सेट छैनो',
            ]);
        }

        $this->structureTypes = StructureType::latest()->get();
        $this->allDistricts = get_districts();
    }





    // public function addStoreyDetail(): void
    // {
    //     if (count($this->applyMap['storeyDetails']) < $this->applyMap['current_storey']) {
    //         $this->applyMap['storeyDetails'][] = [];
    //     }
    // }

    // public function removeStoreyDetail($index): void
    // {
    //     unset($this->applyMap['storeyDetails'][$index]);
    //     $this->applyMap['storeyDetails'] = array_values($this->applyMap['storeyDetails']);
    // }

    public function setStructureType(): void
    {
        $this->open_structure_type = !$this->open_structure_type;
    }

    protected array $applyMapValidations = [
        'applyMap.application_type' => ['required'],
        'applyMap.organization_id' => ['required'],
        'applyMap.construction_type' => ['required'],
        'applyMap.current_storey' => ['required', 'numeric'],
        'applyMap.future_storey' => ['required', 'numeric'],
        // 'applyMap.storeyDetails' => ['nullable', 'array'],
        // 'applyMap.storeyDetails.*.map_fee_id' => ['required', 'exists:map_fees,id'],
        // 'applyMap.storeyDetails.*.area_of_proposed_construction' => ['required', 'numeric'],
        // 'applyMap.storeyDetails.*.area_of_former_construction' => ['nullable', 'numeric'],
        // 'applyMap.storeyDetails.*.total_area' => ['required', 'numeric'],
        // 'applyMap.storeyDetails.*.height' => ['required', 'numeric'],
    ];

    protected array $landDescriptionValidations = [
        'landDescription.ward_no' => ['required', 'integer'],
        'landDescription.former_ward_no' => ['nullable', 'integer'],
        'landDescription.tole' => ['nullable'],
        'landDescription.plot_no' => ['required'],
        'landDescription.unit_value' => ['nullable'],

    ];

    protected array $landOwnerValidations = [
        'landOwner.land_owner_type' => ['required'],
        'landOwner.name' => ['required'],
        'landOwner.phone' => ['nullable'],
        'landOwner.father_name' => ['required'],
        'landOwner.grandfather_name' => ['required'],
        'landOwner.citizenship_issue_district_id' => ['required', 'exists:districts,id'],
        'landOwner.citizenship_no' => ['required'],
        'landOwner.citizenship_issue_date' => ['required'],
        'landOwner.address' => ['required'],
        'landOwner.local_body' => ['required'],
        'landOwner.ward_no' => ['required', 'integer'],
    ];

    protected array $houseOwnerValidations = [
        'houseOwner.name' => ['required'],
        'houseOwner.phone' => ['nullable'],
        'houseOwner.father_name' => ['required'],
        'houseOwner.grandfather_name' => ['required'],
        'houseOwner.citizenship_issue_district_id' => ['required', 'exists:districts,id'],
        'houseOwner.citizenship_no' => ['required'],
        'houseOwner.citizenship_issue_date' => ['required'],
        'houseOwner.address' => ['required'],
        'houseOwner.local_body' => ['required'],
        'houseOwner.ward_no' => ['required', 'integer'],
    ];

    protected array $applicantDetailValidations = [
        'applicantDetail.applicant_type' => ['required'],
        'applicantDetail.relation_with_owner' => ['required'],
        'applicantDetail.name' => ['required'],
        'applicantDetail.phone' => ['required'],
        'applicantDetail.father_name' => ['required'],
        'applicantDetail.citizenship_issue_district_id' => ['required'],
        'applicantDetail.citizenship_no' => ['required'],
        'applicantDetail.citizenship_issue_date' => ['required'],
        'applicantDetail.application_date' => ['nullable'],
        'applicantDetail.signature' => ['nullable', 'image'],
    ];

    public function rules(): array
    {
        return array_merge(
            $this->applyMapValidations,
            $this->landDescriptionValidations,
            $this->landOwnerValidations,
            $this->houseOwnerValidations,
            $this->applicantDetailValidations
        );
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function saveFormData(): void
    {
        $this->validate();
        $data = DB::transaction(function () {


            $mapApply = MapApply::create($this->applyMap + [
                'fiscal_year_id' => OfficeSetting::first()->fiscal_year_id,
                'sent_to_organization' => 'pending'
            ]);

            // foreach ($this->applyMap['storeyDetails'] as $storeyDetail) {
            //     $mapApply->storeyDetails()->create($storeyDetail);
            // }

            $mapApply->landDetail()->create($this->landDescription + [
                'unit_id' => MapSetting::first()->land_measurement_standard_id ?? null,
            ]);

            $mapApply->houseOwner()->create($this->houseOwner);

            $mapApply->landOwner()->create($this->landOwner);

            $mapApply->applicantDetail()->create($this->applicantDetail);

            Notification::send($mapApply->organization, new MapApplyNotification($mapApply));

            return $mapApply;
        });


        $this->reset('applyMap', 'landDescription', 'landOwner', 'houseOwner', 'applicantDetail');

        $this->dispatchBrowserEvent('alert_message', [
            'type' => 'success',
            'title' => 'धन्यबाद!!!',
            'text' => "तपाईंको फारम सफलतापूर्वक पेश भएको छ, तपाईंको सबमिशन नं. $data->unique_id हो। कृपया भविष्यमा प्रयोगको लागि सबमिशन नं. सुरक्षित राख्नुहोस्।",
        ]);
    }

    public function messages(): array
    {
        return [
            'applyMap.application_type.required' => 'अनिवार्य छ',
            'applyMap.construction_type.required' => 'निर्माण कार्यको किसिम अनिवार्य छ |',
            'applyMap.current_storey.required' => 'तल्ला संख्या अनिवार्य छ|',
            'applyMap.current_storey.numeric' => 'तल्ला संख्या नम्बरमा हुनुपर्छ|',
            'applyMap.area_of_plinth.required' => 'क्षेत्रफल अनिवार्य छ|',
            'applyMap.area_of_plinth.numeric' => 'क्षेत्रफल नम्बरमा हुनुपर्छ|',
            'applyMap.future_storey.required' => 'तल्ला संख्या अनिवार्य छ|',
            'applyMap.future_storey.numeric' => 'तल्ला संख्या नम्बरमा हुनुपर्छ|',
            'applyMap.length.required' => 'भवनको लम्बाई अनिवार्य छ|',
            'applyMap.length.numeric' => 'भवनको लम्बाई नम्बरमा हुनुपर्छ|',
            'applyMap.breadth.required' => 'भवनको चौडाई अनिवार्य छ|',
            'applyMap.breadth.numeric' => 'भवनको चौडाई नम्बरमा हुनुपर्छ|',
            'applyMap.height.required' => 'भवनको उचाई अनिवार्य छ|',
            'applyMap.height.numeric' => 'भवनको उचाई नम्बरमा हुनुपर्छ|',
            'applyMap.storeyDetails.*.map_fee_id.required' => 'तल्ला अनिवार्य छ|',
            'applyMap.storeyDetails.*.area_of_proposed_construction.required' => ' प्रस्तावित  क्षेत्रफल अनिवार्य छ|',
            'applyMap.storeyDetails.*.area_of_proposed_construction.numeric' => 'प्रस्तावित  क्षेत्रफल नम्बरमा हुनुपर्छ|',
            'applyMap.storeyDetails.*.area_of_former_construction.required' => 'साविक क्षेत्रफल अनिवार्य छ|',
            'applyMap.storeyDetails.*.area_of_former_construction.numeric' => 'साविक क्षेत्रफल नम्बरमा हुनुपर्छ|',
            'applyMap.storeyDetails.*.total_area.required' => 'जम्मा क्षेत्रफल अनिवार्य छ|',
            'applyMap.storeyDetails.*.total_area.numeric' => 'जम्मा क्षेत्रफल नम्बरमा हुनुपर्छ|',
            'applyMap.storeyDetails.*.height.required' => 'उचाई अनिवार्य छ|',
            'applyMap.storeyDetails.*.height.numeric' => 'उचाई नम्बरमा हुनुपर्छ|',
            'landDescription.land_use_area_id.required' => 'भू-उपयोग्य क्षेत्र अनिवार्य छ|',
            'landDescription.land_use_area_id.numeric' => 'भू-उपयोग्य क्षेत्र नम्बरमा हुनुपर्छ|',
            'landDescription.ward_no.required' => 'वडा नं अनिवार्य छ|',
            'landDescription.ward_no.integer' => 'वडा नं नम्बरमा हुनुपर्छ|',
            'landDescription.former_ward_no.required' => ' साविक वडा नं अनिवार्य छ|',
            'landDescription.former_ward_no.integer' => ' साविक वडा नं नम्बरमा हुनुपर्छ|',
            'landDescription.plot_no.required' => 'कित्ता नं अनिवार्य छ|',
            'landDescription.percentage_of_area_covered_by_building.required' => ' क्षेत्रफलको प्रतिशत अनिवार्य छ|',
            'landDescription.percentage_of_area_covered_by_building.numeric' => 'क्षेत्रफलको प्रतिशत नम्बरमा हुनुपर्छ|',
            'landOwner.land_owner_type.required' => 'जग्गा धनीको किसिम अनिवार्य छ|',
            'landOwner.name.required' => 'नाम अनिवार्य छ|',
            'landOwner.father_name.required' => ' बुवाको नाम अनिवार्य छ|',
            'landOwner.citizenship_issue_district_id.required' => 'जिल्ला अनिवार्य छ|',
            'landOwner.citizenship_no.required' => 'नागरिकत नम्बर अनिवार्य छ|',
            'landOwner.citizenship_issue_date.required' => ' मिति अनिवार्य छ|',
            'landOwner.address.required' => ' ठेगाना अनिवार्य छ|',
            'houseOwner.name.required' => 'घर धनीको नाम अनिवार्य छ|',
            'houseOwner.father_name.required' => 'बुवाको नाम अनिवार्य छ|',
            'houseOwner.citizenship_issue_district_id.required' => 'जिल्ला अनिवार्य छ|',
            'houseOwner.citizenship_no.required' => ' नागरिकत नम्बर अनिवार्य छ|',
            'houseOwner.citizenship_issue_date.required' => 'मिति अनिवार्य छ|',
            'houseOwner.address.required' => 'ठेगाना अनिवार्य छ|',
            'applicantDetail.applicant_type.required' => 'निवेदकको प्रकार अनिवार्य छ|',
            'applicantDetail.relation_with_owner.required' => ' सम्बन्ध अनिवार्य छ|',
            'applicantDetail.name.required' => 'नाम अनिवार्य छ|',
            'applicantDetail.phone.required' => 'फोन न. अनिवार्य छ|',
            'applicantDetail.father_name.required' => 'वाबुको नाम अनिवार्य छ|',
            'applicantDetail.citizenship_issue_district_id.required' => 'जारी जिल्ला अनिवार्य छ|',
            'applicantDetail.citizenship_no.required' => 'नागरिकता न. अनिवार्य छ|',
            'applicantDetail.citizenship_issue_date.required' => 'जारी मिति अनिवार्य छ|',
            'applicantDetail.signature.required' => 'निवेदकको सहि अनिवार्य छ|',
            'criteriaDetails.required' => 'मापदण्ड विवरण अनिवार्य छ|',
            'criteriaDetails.*.according_to_criteria.required' => 'मापदण्ड अनुसार अनिवार्य छ|',
            'criteriaDetails.*.according_to_map.required' => 'नक्सा अनुसार अनिवार्य छ|',
            'criteriaDetails.*.compliance.required' => 'अनुपालन अनिवार्य छ|',
            'buildingDetails.required' => 'भवन सम्बन्धि विवरण अनिवार्य छ|',
            'buildingDetails.*.description.required' => 'विवरण अनिवार्य छ|',
            'applyMap.consultant_signature.required' => 'इंन्जिनियरको सहि अनिवार्य छ|',
            'applyMap.consultant_signature.image' => 'सहिको फोटो हुनुपर्छ |',
            'applyMap.consultant_name.required' => 'नाम अनिवार्य छ|',
            'applyMap.consultant_mobile_no.required' => ' मोबाइल नं. अनिवार्य छ|',
            'applyMap.consultant_nec_no.required' => ' एन. ई. सी. नं अनिवार्य छ|',
        ];
    }

    public function checkSameAsLandOwner(): void
    {
        $this->same_as_land_owner = !$this->same_as_land_owner;
        if ($this->same_as_land_owner) {
            $this->houseOwner = [
                'name' => $this->landOwner['name'] ?? null,
                'phone' => $this->landOwner['phone'] ?? null,
                'father_name' => $this->landOwner['father_name'] ?? null,
                'grandfather_name' => $this->landOwner['grandfather_name'] ?? null,
                'citizenship_issue_district_id' => $this->landOwner['citizenship_issue_district_id'] ?? null,
                'citizenship_no' => $this->landOwner['citizenship_no'] ?? null,
                'citizenship_issue_date' => $this->landOwner['citizenship_issue_date'] ?? null,
                'address' => $this->landOwner['address'] ?? null,
                'local_body' => $this->landOwner['local_body'] ?? null,
                'ward_no' => $this->landOwner['ward_no'] ?? null,
            ];
        } else {
            $this->houseOwner = [
                'name' => null,
                'phone' => null,
                'father_name' => null,
                'grandfather_name' => null,
                'citizenship_issue_district_id' => null,
                'citizenship_no' => null,
                'citizenship_issue_date' => null,
                'address' => null,
                'local_body' => null,
                'ward_no' => null,
            ];
        }
    }

    public function setApplicantData(): void
    {
        switch ($this->applicantDetail['applicant_type']) {
            case 'house owner':
                $this->applicantDetail['name'] = $this->houseOwner['name'] ?? '';
                $this->applicantDetail['phone'] = $this->houseOwner['phone'] ?? '';
                $this->applicantDetail['father_name'] = $this->houseOwner['father_name'] ?? '';
                $this->applicantDetail['citizenship_issue_district_id'] = $this->houseOwner['citizenship_issue_district_id'] ?? '';
                $this->applicantDetail['citizenship_no'] = $this->houseOwner['citizenship_no'] ?? '';
                $this->applicantDetail['citizenship_issue_date'] = $this->houseOwner['citizenship_issue_date'] ?? '';
                break;
            case 'land owner':
                $this->applicantDetail['name'] = $this->landOwner['name'] ?? '';
                $this->applicantDetail['phone'] = $this->landOwner['phone'] ?? '';
                $this->applicantDetail['father_name'] = $this->landOwner['father_name'] ?? '';
                $this->applicantDetail['citizenship_issue_district_id'] = $this->landOwner['citizenship_issue_district_id'] ?? '';
                $this->applicantDetail['citizenship_no'] = $this->landOwner['citizenship_no'] ?? '';
                $this->applicantDetail['citizenship_issue_date'] = $this->landOwner['citizenship_issue_date'] ?? '';
                break;
            default:
                $this->applicantDetail['name'] = null;
                $this->applicantDetail['phone'] = null;
                $this->applicantDetail['father_name'] = null;
                $this->applicantDetail['citizenship_issue_district_id'] = null;
                $this->applicantDetail['citizenship_no'] = null;
                $this->applicantDetail['citizenship_issue_date'] = null;
        }
    }

    public function render()
    {
        $this->setApplicantData();

        return view('emap::livewire.map-application-form');
    }
}
