<?php

use App\Enums\OfficeTypeEnum;

return [
    'to_office' => [
        'to' => 'श्रीमान प्रमुख प्रशासकिय अधिकृत ज्यू',
        'office_name' => 'नेपालगंज उप-महानगरपालिका',
        'office' => 'नगर कार्यपालिकाको कार्यालय',
        'office_address' => 'नेपालगंज, बाँके',
    ],
    'place' => 'नेपालगंज',
    'office_district' => 'बाँके',
    'place_short_name' => 'ने.',
    'office_type' => OfficeTypeEnum::SUB_METROPOLITAN->label(),
    'office_short_name' => OfficeTypeEnum::SUB_METROPOLITAN->shortName(),
];
