<?php

namespace Modules\Identity\Traits;

use App\Traits\NepaliDateConverter;
use Illuminate\Support\Str;
use Modules\Identity\Entities\MinuteTemplateSetting;
use View;

trait IdentityMinuteTemplateTrait
{
    use NepaliDateConverter;

    private array $template = [
        [
            'title' => 'मीटिंग विवरण',
            'data' => [
                'शिर्षक' => '[@title]',
                'मिति (बि.सं.)' => '[@date_bs]',
                'मिति (ई.सं.)' => '[@date_ad]',
                'विवरण' => '[@description]',
            ],
        ],
        [
            'title' => 'अन्य विवरण',
            'data' => [
                'अपाङ्ग समिति विवरण' => '[@disabilityCommitteeDetail]',
                'आमन्त्रित सदस्य विवरण' => '[@invitedGuestDetail]',
                'अपाङ्ग विवरण' => '[@disableDetail]',
                'लेटर हेड (नेपालीमा)' => '[@letterHead]',
                'लेटर हेड (अंग्रेजीमा)' => '[@letterHeadEn]',
            ],
        ],
    ];


    public function getIdentityTemplateData(MinuteTemplateSetting $minuteTemplateSetting = null): string
    {
        if ($minuteTemplateSetting !== null) {
            return $this->getData($minuteTemplateSetting->description);
        } else {
            return "Error: MinuteTemplateSetting is null.";
        }
    }


    public function getTemplateOptions(): array
    {
        return $this->template;
    }

    private function getData($data): string
    {
        $replace = [];

        $replace = array_merge(
            $this->getMainTableData(),
            $this->getRelationData(),
            $replace
        );
        return Str::replace(array_keys($replace), $replace, $data);
    }

    public function getMainTableData(): array
    {
        return [
            '[@title]' => $this->title ?? '',
            '[@date_bs]' => get_nepali_number($this->date_bs) ?? '',
            '[@date_ad]' => get_nepali_number($this->date_ad) ?? '',
            '[@description]' => $this->description ?? '',
        ];
    }


    public function getRelationData(): array
    {
        $disabilityCommittees = $this->load('disabilityCommittees')->disabilityCommittees;
        $invitedGuests = $this->load('invitedGuests')->invitedGuests;
        $disabilityIdentityCards = $this->load('disabilityIdentityCards.governmentalDisabilityType')->disabilityIdentityCards;
        return [
            '[@letterHead]' => letterHead() ?? '',
            '[@letterHeadEn]' => letterHeadEn() ?? '',
            '[@disabilityCommitteeDetail]' => View::make('identity::admin.template.minutes.disabilityCommitteeDetail', compact('disabilityCommittees')),
            '[@invitedGuestDetail]' => View::make('identity::admin.template.minutes.invitedGuestDetail', compact('invitedGuests')),
            '[@disableDetail]' => View::make('identity::admin.template.minutes.disableDetail', compact('disabilityIdentityCards')),
        ];
    }

}
