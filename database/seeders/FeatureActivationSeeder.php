<?php

namespace Database\Seeders;

use App\Enums\FeatureTypeEnum;
use App\Models\FeatureActivation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class FeatureActivationSeeder extends Seeder
{
    public function run()
    {
        FeatureActivation::truncate();
        if (Cache::has('settings')) {
            Cache::forget('settings');
        }
        $data = [
            [
                'feature_name_ne' => 'आकाश एस.एम.एस.',
                'feature_name_en' => 'Aakash Sms',
                'feature_key' => 'aakash_sms',
                'feature_description' => 'आकाश एस.एम.एस. प्रयोग गर्नको लागि कन्फिगर गर्नुहोस ।',
                'feature_status' => true,
                'feature_type' => FeatureTypeEnum::SMS->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'feature_name_ne' => 'समय एस.एम.एस.',
                'feature_name_en' => 'Samaya Sms',
                'feature_key' => 'samaya_sms',
                'feature_description' => 'समय एस.एम.एस. प्रयोग गर्नको लागि कन्फिगर गर्नुहोस ।',
                'feature_status' => false,
                'feature_type' => FeatureTypeEnum::SMS->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'feature_name_ne' => 'ई-मेल',
                'feature_name_en' => 'Email',
                'feature_key' => 'email',
                'feature_description' => 'ई-मेल प्रयोग गर्नको लागि कन्फिगर गर्नुहोस ।',
                'feature_status' => true,
                'feature_type' => FeatureTypeEnum::MAIL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'feature_name_ne' => 'पिन',
                'feature_name_en' => 'Pin',
                'feature_key' => 'pin',
                'feature_description' => null,
                'feature_status' => true,
                'feature_type' => FeatureTypeEnum::PIN->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        FeatureActivation::insert($data);
    }
}
