<?php

namespace Modules\JudicialCommittee\Traits;

use App\Traits\NepaliDateConverter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Modules\JudicialCommittee\Entities\DateCompensation;
use Modules\JudicialCommittee\Entities\DateSheet;
use Modules\JudicialCommittee\Entities\DefendantIssuedDeadline;
use Modules\JudicialCommittee\Entities\JudicialCommitteeTemplate;
use Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum;
use Modules\JudicialCommittee\Enums\JudicialTemplateTypeEnum;

trait JudicialCommitteeTemplateTrait
{
    use NepaliDateConverter;

    private array $template = [
        [
            'title' => 'विवरण',
            'data' => [
                'कार्यालय नाम' => '[@office_name]',
                'कार्यालय लेटर हेड' => '[@letter_head]',
                'आजको मिति' => '[@today_date]',
            ],
        ],
        [
            'title' => 'निवेदक को विवरण',
            'data' => [
                'आवेदकको नाम' => '[@applicant_name]',
                'आवेदक फोन' => '[@applicant_phone]',
                'आवेदक ठेगाना' => '[@applicant_address]',
            ],
        ],
        [
            'title' => 'वादीको विवरण',
            'data' => [
                'वादीको नाम (संक्षिप्त)' => '[@complainant.brief_name]',
                'वादीहरुको पुरा विवरण' => '[@complainant.full_description]',
                'साक्षीहरु' => '[@complainant.witnesses]',
                'वादीको नाम' => '[@complainant.name]',
                'वादीको उमेर' => '[@complainant.age]',
                'बुवाको नाम' => '[@complainant.father_name]',
                'हजुरबुबाको नाम' => '[@complainant.grandfather_name]',
                'पति/पत्नीको नाम' => '[@complainant.spouse_name]',
                'प्रदेश' => '[@complainant.province]',
                'जिल्ला' => '[@complainant.district]',
                'स्थानीय तह' => '[@complainant.local_body]',
                'वडा नं.' => '[@complainant.ward_no]',
                'टोल' => '[@complainant.tole]'
            ],
        ],
        [
            'title' => 'प्रतिवादी विवरण',
            'data' => [
                'प्रतिवादीको नाम (संक्षिप्त)' => '[@defendant.brief_name]',
                'प्रतिवादीहरुको पुरा विवरण' => '[@defendant.full_description]',
                'साक्षीहरु' => '[@complainant.witnesses]',
                'प्रतिवादीको नाम' => '[@defendant.name]',
                'प्रतिवादीको उमेर' => '[@defendant.age]',
                'बुवाको नाम' => '[@defendant.father_name]',
                'हजुरबुबाको नाम' => '[@defendant.grandfather_name]',
                'पति/पत्नीको नाम' => '[@defendant.spouse_name]',
                'प्रदेश' => '[@defendant.province]',
                'जिल्ला' => '[@defendant.district]',
                'स्थानीय तह' => '[@defendant.local_body]',
                'वडा नं.' => '[@defendant.ward_no]',
                'टोल' => '[@defendant.tole]'
            ],
        ],
        [
            'title' => 'उजुरी विवरण',
            'data' => [
                'सबमिशन नं.' => '[@submission_no]',
                'दर्ता नम्बर' => '[@registration_no]',
                'मुद्दा प्रकृति' => '[@lawsuit_nature]',
                'विषय' => '[@subject]',
                'मिति' => '[@date]',
                'विवरण' => '[@complaint_detail]',
            ],
        ],
        [
            'title' => 'दर्ता दस्तुर विवरण',
            'data' => [
                'बिल नम्बर' => '[@judicialReceiptBill.bill_no]',
                'प्रवेश गर्ने व्यक्ति' => '[@judicialReceiptBill.entry_person]',
                'रकम' => '[@judicialReceiptBill.amount]',
                'बिल मिति' => '[@judicialReceiptBill.bill_date]'
            ],
        ],
        [
            'title' => 'तारिख पर्चा विवरण',
            'data' => [
                'आवेदन वर्ष' => '[@dateSheet.year]',
                'केस नाम' => '[@dateSheet.case_name]',
                'हाजिर हुने मिति' => '[@dateSheet.appearance_date]',
                'हाजिर हुने समय' => '[@dateSheet.appearance_time]',
                'पेश मिति' => '[@dateSheet.submitted_date]'
            ],
        ],
        [
            'title' => 'प्रतिवादी म्याद जारी विवरण',
            'data' => [
                'पछिल्लो जारी म्याद मिति' => '[@defendantIssuedDeadline.last_submitted_date]',
                'पछिल्लो सहभागी हुनुपर्ने दिन' => '[@defendantIssuedDeadline.last_day_to_attend]',
                'सहभागी हुनुपर्ने दिन' => '[@defendantIssuedDeadline.day_to_attend]',
                'पेश मिति' => '[@defendantIssuedDeadline.submitted_date]'
            ],
        ],
        [
            'title' => 'तारिख भरपाई विवरण',
            'data' => [
                'निर्णय हुने मिति' => '[@dateCompensation.decision_date]',
                'निर्णय हुने विषय' => '[@dateCompensation.decision_subject]',
                'निर्णय हुने समय' => '[@dateCompensation.decision_time]',
                'पेश मिति' => '[@dateCompensation.submitted_date]'
            ],
        ],
    ];

    public function getTemplateDataAttribute(): Collection
    {
        return $this->getJudicialCommitteeTemplates()->map(function ($applicationTemplate) {
            $data = $this->getData($applicationTemplate->data);

            return [
                'for' => $applicationTemplate->for,
                'data' => $data,
            ];
        });
    }

    public function getSpecificTemplateData(JudicialTemplateTypeEnum $judicialTemplateTypeEnum): string
    {
        $judicialCommitteeTemplates = $this->getJudicialCommitteeTemplates();
        $judicialTemplate = $judicialCommitteeTemplates->where('type', $judicialTemplateTypeEnum)->first();

        if ($judicialTemplate) {
            return $this->getData($judicialTemplate->data);
        }

        return '';
    }

    public function getDateSheetTemplate(DateSheet $dateSheet): string
    {
        $judicialCommitteeTemplates = $this->getJudicialCommitteeTemplates();
        $judicialTemplate = $judicialCommitteeTemplates->where('type', JudicialTemplateTypeEnum::DATE_SHEET)->first();

        if ($judicialTemplate) {
            $replace = [];

            $replace = array_merge(
                $this->getComplaintApplicationReplacement(),
                $replace,
                [
                    '[@dateSheet.year]' => $dateSheet->year ?? '',
                    '[@dateSheet.case_name]' => $dateSheet->case_name ?? '',
                    '[@dateSheet.appearance_date]' => $dateSheet->appearance_date ?? '',
                    '[@dateSheet.appearance_time]' => $dateSheet->appearance_time ?? '',
                    '[@dateSheet.submitted_date]' => $dateSheet->submitted_date ?? ''
                ]
            );

            return Str::replace(array_keys($replace), $replace, $judicialTemplate->data);
        }

        return '';
    }

    public function getDateCompensationTemplate(DateCompensation $dateCompensation): string
    {
        $judicialCommitteeTemplates = $this->getJudicialCommitteeTemplates();
        $judicialTemplate = $judicialCommitteeTemplates->where('type', JudicialTemplateTypeEnum::DATE_COMPENSATION)->first();

        if ($judicialTemplate) {
            $replace = [];

            $replace = array_merge(
                $this->getComplaintApplicationReplacement(),
                $replace,
                [
                    '[@dateCompensation.decision_date]' => $dateCompensation->decision_date ?? '',
                    '[@dateCompensation.decision_subject]' => $dateCompensation->decision_subject ?? '',
                    '[@dateCompensation.decision_time]' => $dateCompensation->decision_time ?? '',
                    '[@dateCompensation.submitted_date]' => $dateCompensation->submitted_date ?? '',
                ]
            );

            return Str::replace(array_keys($replace), $replace, $judicialTemplate->data);
        }

        return '';
    }

    public function getDefendantIssuedDeadlineTemplate(DefendantIssuedDeadline $defendantIssuedDeadline): string
    {
        $judicialCommitteeTemplates = $this->getJudicialCommitteeTemplates();
        $judicialTemplate = $judicialCommitteeTemplates->where('type', JudicialTemplateTypeEnum::DEFENDANT_ISSUED_DEADLINE)->first();

        if ($judicialTemplate) {
            $replace = [];

            $replace = array_merge(
                $this->getComplaintApplicationReplacement(),
                $replace,
                [
                    '[@defendantIssuedDeadline.day_to_attend]' => $defendantIssuedDeadline->day_to_attend ?? '',
                    '[@defendantIssuedDeadline.submitted_date]' => $defendantIssuedDeadline->submitted_date ?? ''
                ]
            );

            return Str::replace(array_keys($replace), $replace, $judicialTemplate->data);
        }

        return '';
    }

    public function getTemplateOptions(): array
    {
        return $this->template;
    }

    private function getData($data): string
    {
        $replace = [];

        $replace = array_merge(
            $this->getComplaintApplicationReplacement(),
            $replace,
            $this->getJudicialReceiptBillReplacement()
        );

        return Str::replace(array_keys($replace), $replace, $data);
    }

    private function getOfficeSettingReplacement(): array
    {
        return [
            '[@office_name]' => officeSetting()->name,
            '[@letter_head]' => letterHead(),
            '[@today_date]' => $this->get_today_nepali_date(),
        ];
    }

    private function getComplaintApplicationReplacement(): array
    {
        return array_merge(
            [
                '[@applicant_name]' => $this->applicant_name ?? '',
                '[@applicant_phone]' => $this->applicant_phone ?? '',
                '[@applicant_address]' => $this->applicant_address ?? '',
                //complaint details
                '[@submission_no]' => $this->submission_no ?? '',
                '[@registration_no]' => $this->registration_no ?? '',
                '[@lawsuit_nature]' => $this->lawsuitNature->title ?? '',
                '[@subject]' => $this->subject ?? '',
                '[@date]' => $this->date ?? '',
                '[@complaint_detail]' => $this->complaint_detail ?? '',
                //last defendant issued deadline
                '[@defendantIssuedDeadline.last_submitted_date]' => $this->defendantIssuedDeadlines?->last()->submitted_date ?? '',
                '[@defendantIssuedDeadline.last_day_to_attend]' => $this->defendantIssuedDeadlines?->last()->day_to_attend ?? ''
            ],
            $this->getComplainantReplacement(),
            $this->getDefendantReplacement(),
            $this->getOfficeSettingReplacement()
        );
    }

    private function getComplainantReplacement(): array
    {
        $complainants = $this->complainantDefendants->where('type', ComplainantDefendantTypeEnum::COMPLAINANT);
        $complainants->load('province', 'district', 'localBody');
        $witnesses = $this->witnesses->where('type', ComplainantDefendantTypeEnum::COMPLAINANT);

        return [
            '[@complainant.brief_name]' => ($complainants?->first()->name ?? '') . ($complainants->count() > 1 ? " सहित " . ($complainants->count() - 1) . " जना" : ''),
            '[@complainant.full_description]' => (string)View::make('judicialcommittee::admin.setting.template.inc.complainant_defendants', [
                'data' => $complainants
            ]),
            '[@complainant.witnesses]' => (string)View::make('judicialcommittee::admin.setting.template.inc.witness_list', compact('witnesses')),
            '[@complainant.name]' => implode(',', $complainants->pluck('name')->toArray()),
            '[@complainant.age]' => ($complainants?->first()->age ?? ''),
            '[@complainant.father_name]' => ($complainants?->first()->father_name ?? ''),
            '[@complainant.grandfather_name]' => ($complainants?->first()->grandfather_name ?? ''),
            '[@complainant.spouse_name]' => ($complainants?->first()->spouse_name ?? ''),
            '[@complainant.province]' => ($complainants?->first()->province->province ?? ''),
            '[@complainant.district]' => ($complainants?->first()->district->district ?? ''),
            '[@complainant.local_body]' => ($complainants?->first()->localBody->local_body ?? ''),
            '[@complainant.ward_no]' => ($complainants?->first()->ward_no ?? ''),
            '[@complainant.tole]' => ($complainants?->first()->tole ?? ''),
        ];
    }

    private function getDefendantReplacement(): array
    {
        $defendants = $this->complainantDefendants->where('type', ComplainantDefendantTypeEnum::DEFENDANT);
        $defendants->load('province', 'district', 'localBody');
        $witnesses = $this->witnesses->where('type', ComplainantDefendantTypeEnum::DEFENDANT);

        return [
            '[@defendant.brief_name]' => ($defendants?->first()->name ?? '') . ($defendants->count() > 1 ? " सहित " . ($defendants->count() - 1) . " जना" : ''),
            '[@defendant.full_description]' => (string)View::make('judicialcommittee::admin.setting.template.inc.complainant_defendants', [
                'data' => $defendants
            ]),
            '[@defendant.witnesses]' => (string)View::make('judicialcommittee::admin.setting.template.inc.witness_list', compact('witnesses')),
            '[@defendant.name]' => implode(',', $defendants->pluck('name')->toArray()),
            '[@defendant.age]' => ($defendants?->first()->age ?? ''),
            '[@defendant.father_name]' => ($defendants?->first()->father_name ?? ''),
            '[@defendant.grandfather_name]' => ($defendants?->first()->grandfather_name ?? ''),
            '[@defendant.spouse_name]' => ($defendants?->first()->spouse_name ?? ''),
            '[@defendant.province]' => ($defendants?->first()->province->province ?? ''),
            '[@defendant.district]' => ($defendants?->first()->district->district ?? ''),
            '[@defendant.local_body]' => ($defendants?->first()->localBody->local_body ?? ''),
            '[@defendant.ward_no]' => ($defendants?->first()->ward_no ?? ''),
            '[@defendant.tole]' => ($defendants?->first()->tole ?? ''),
        ];
    }

    private function getJudicialReceiptBillReplacement(): array
    {
        return [
            '[@judicialReceiptBill.bill_no]' => $this->judicialReceiptBill->bill_no ?? '',
            '[@judicialReceiptBill.entry_person]' => $this->judicialReceiptBill->entry_person ?? '',
            '[@judicialReceiptBill.amount]' => $this->judicialReceiptBill->amount ?? '',
            '[@judicialReceiptBill.bill_date]' => $this->judicialReceiptBill->bill_date ?? '',
        ];
    }

    /**
     * @return mixed
     */
    public function getJudicialCommitteeTemplates(): mixed
    {
        return Cache::rememberForever('judicialCommitteeTemplates', function () {
            return JudicialCommitteeTemplate::all();
        });
    }
}
