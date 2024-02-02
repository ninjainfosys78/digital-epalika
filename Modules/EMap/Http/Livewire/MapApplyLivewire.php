<?php

namespace Modules\EMap\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\MapSetting;
use Modules\EMap\Enums\BuildingDetailEnum;
use Modules\EMap\Enums\DetailsRegardingCriteriaEnum;
use Modules\EMap\Enums\FourSideParticularEnum;
use Modules\EMap\Enums\PostsEnum;

class MapApplyLivewire extends Component
{
    use WithFileUploads;

    public MapApply $mapApply;

    public int $currentStep = 1;

    //    conversion
    public $conversion_units = [];

    public $conversion = [];

    public MapSetting $setting;

    public object $officeSetting;

    public array $applyMap = [
        'consultant_signature' => null,
        'consultant_name' => null,
        'consultant_mobile_no' => null,
        'consultant_nec_no' => null,
    ];

    public array $fourFortDetails = [];

    public array $designerDetails = [];

    public array $criteriaDetails = [];

    public array $buildingDetails = [];

    public function mount(MapApply $mapApply): void
    {
        $this->setting = MapSetting::with('landMeasurement')->first();

        $this->mapApply = $mapApply;

        foreach (FourSideParticularEnum::cases() as $fourSide) {
            $this->fourFortDetails[] = [
                'detail' => $fourSide->value,
                'east' => null,
                'west' => null,
                'south' => null,
                'north' => null,
            ];
        }

        foreach (PostsEnum::cases() as $designerDetail) {
            $this->designerDetails[] = [
                'post' => $designerDetail->value,
                'name' => null,
                'father_name' => null,
                'grandfather_name' => null,
                'phone' => null,
                'address' => null,
                'local_body' => null,
                'ward_no' => null,
                'nec_council_no' => null,
                'local_body_registration_no' => null,
                'consulting_firm_name' => null,
            ];
        }

        foreach (DetailsRegardingCriteriaEnum::cases() as $criteriaDetail) {
            $this->criteriaDetails[] = [
                'detail' => $criteriaDetail->value,
                'according_to_criteria' => null,
                'according_to_map' => null,
                'compliance' => null,
                'remarks' => $criteriaDetail->remarks(),
            ];
        }

        $this->buildingDetails =
            [
                [
                    'detail' => BuildingDetailEnum::BUILDING_CATEGORY->value,
                    'description' => $mapApply->building_category?->label(),
                    'remarks' => null,
                ],
                [
                    'detail' => BuildingDetailEnum::PLINTH_AREA->value,
                    'description' => $mapApply->area_of_plinth ?? null,
                    'remarks' => null,
                ],
                [
                    'detail' => BuildingDetailEnum::LENGTH->value,
                    'description' => $mapApply->length ?? '',
                    'remarks' => null,
                ],
                [
                    'detail' => BuildingDetailEnum::BREADTH->value,
                    'description' => $mapApply->breadth ?? '',
                    'remarks' => null,
                ],
                [
                    'detail' => BuildingDetailEnum::STOREY_COUNT->value,
                    'description' => $mapApply->current_storey ?? '',
                    'remarks' => null,
                ],
                [
                    'detail' => BuildingDetailEnum::HEIGHT->value,
                    'description' => $mapApply->height ?? null,
                    'remarks' => null,
                ],
            ];
    }

    protected array $fourFortValidations = [
        'fourFortDetails' => ['required', 'array'],
        'fourFortDetails.*.detail' => ['required'],
        'fourFortDetails.*.east' => ['required'],
        'fourFortDetails.*.south' => ['required'],
        'fourFortDetails.*.west' => ['required'],
        'fourFortDetails.*.north' => ['required'],
    ];

    protected array $designerDetailValidations = [
        'designerDetails' => ['required', 'array'],
        'designerDetails.*.name' => ['required'],
        'designerDetails.*.father_name' => ['required'],
        'designerDetails.*.grandfather_name' => ['required'],
        'designerDetails.*.phone' => ['required'],
        'designerDetails.*.address' => ['required'],
        'designerDetails.*.local_body' => ['required'],
        'designerDetails.*.ward_no' => ['required', 'integer'],
        'designerDetails.*.post' => ['required'],
        'designerDetails.*.nec_council_no' => ['required'],
        'designerDetails.*.local_body_registration_no' => ['required'],
        'designerDetails.*.consulting_firm_name' => ['required'],
    ];

    protected array $criteriaDetailValidations = [
        'criteriaDetails' => ['required', 'array'],
        'criteriaDetails.*.detail' => ['required'],
        'criteriaDetails.*.according_to_criteria' => ['required'],
        'criteriaDetails.*.according_to_map' => ['required'],
        'criteriaDetails.*.compliance' => ['required'],
        'criteriaDetails.*.remarks' => ['nullable'],
    ];

    protected array $buildingDetailValidations = [
        'buildingDetails' => ['required', 'array'],
        'buildingDetails.*.detail' => ['required'],
        'buildingDetails.*.description' => ['required'],
        'buildingDetails.*.remarks' => ['nullable'],
    ];

    protected array $consultantDetailValidations = [
        'applyMap.consultant_signature' => ['nullable', 'image'],
        'applyMap.consultant_name' => ['required'],
        'applyMap.consultant_mobile_no' => ['required'],
        'applyMap.consultant_nec_no' => ['required'],
    ];

    public function rules(): array
    {
        return array_merge(
            $this->fourFortValidations,
            $this->designerDetailValidations,
            $this->criteriaDetailValidations,
            $this->buildingDetailValidations,
            $this->consultantDetailValidations
        );
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function saveFormData(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->mapApply->update($this->applyMap);
            foreach ($this->fourFortDetails as $fourFortDetail) {
                $this->mapApply->fourForts()->create($fourFortDetail);
            }

            foreach ($this->designerDetails as $designerDetail) {
                $this->mapApply->designerDetails()->create($designerDetail);
            }

            foreach ($this->criteriaDetails as $criteriaDetail) {
                $this->mapApply->criteriaDetails()->create($criteriaDetail);
            }

            foreach ($this->buildingDetails as $buildingDetail) {
                $this->mapApply->buildingDetails()->create($buildingDetail);
            }
        });

        $this->reset('fourFortDetails', 'designerDetails', 'criteriaDetails', 'buildingDetails');

        $this->dispatchBrowserEvent('alert_message', [
            'type' => 'success',
            'title' => 'धन्यबाद',
            'text' => 'तपाईको फारम सफलतापूर्वक दर्ता भयो',
        ]);
    }

    public function render()
    {
        return view('emap::livewire.map-apply-livewire');
    }

    public function messages(): array
    {
        return [
            'fourFortDetails.required' => 'चार किल्लाको विवरण अनिवार्य छ|',
            'fourFortDetails.*.east.required' => 'पूर्व दिशा अनिवार्य छ|',
            'fourFortDetails.*.south.required' => 'दक्षिण दिशा अनिवार्य छ|',
            'fourFortDetails.*.west.required' => 'पश्चिम दिशा अनिवार्य छ|',
            'fourFortDetails.*.north.required' => 'उत्तर दिशा अनिवार्य छ|',
            'designerDetails.required' => 'डिजाइनरको विवरण अनिवार्य छ|',
            'designerDetails.*.name.required' => ' नाम अनिवार्य छ|',
            'designerDetails.*.father_name.required' => 'बुबाको नाम अनिवार्य छ|',
            'designerDetails.*.grand_father_name.required' => 'हजुरबुबाको नाम अनिवार्य छ|',
            'designerDetails.*.phone.required' => ' फोन अनिवार्य छ|',
            'designerDetails.*.address.required' => ' ठेगाना अनिवार्य छ|',
            'designerDetails.*.local_body.required' => ' पालिका  अनिवार्य छ|',
            'designerDetails.*.ward_no.required' => ' वडा नं.   अनिवार्य छ|',
            'designerDetails.*.post.required' => 'पद अनिवार्य छ|',
            'designerDetails.*.nec_council_no.required' => 'NEC Council No. अनिवार्य छ|',
            'designerDetails.*.local_body_registration_no.required' => 'पालिकाको दर्ता नं अनिवार्य छ|',
            'designerDetails.*.consulting_firm_name.required' => 'कन्सल्टिंग फर्म नाम अनिवार्य छ|',
            'criteriaDetails.required' => 'मापदण्ड विवरण अनिवार्य छ|',
            'criteriaDetails.*.according_to_criteria.required' => 'मापदण्ड अनुसार अनिवार्य छ|',
            'criteriaDetails.*.according_to_map.required' => 'नक्सा अनुसार अनिवार्य छ|',
            'criteriaDetails.*.compliance.required' => 'अनुपालन अनिवार्य छ|',
            'buildingDetails.required' => 'भवन सम्बन्धि विवरण अनिवार्य छ|',
            'buildingDetails.*.description.required' => 'विवरण अनिवार्य छ|',
        ];
    }
}
