<?php

namespace Modules\Identity\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Identity\Entities\DisabilityType;

class DisabilityTypeTableSeeder extends Seeder
{
    public function run()
    {
        $disabilityTypes = [
            ['title' => 'स्वर बाोलाइ सम्बनि्ध अपाङ्गता','title_en' => 'Speech disability'],
            ['title' => 'न्युन दृष्टी','title_en' => 'Mild visible'],
            ['title' => 'पुर्ण दृष्टी बिहिन','title_en' => 'Complete blind'],
            ['title' => 'बहिरा','title_en' => 'Hearing'],
            ['title' => 'सुस्त श्रवन','title_en' => 'partial hearing'],
            ['title' => 'बौद्धिक अपाङ्गता','title_en' => 'Intellectual'],
            ['title' => 'दृष्टि बिहिन','title_en' => 'blind'],
            ['title' => 'शारीरिक अपाङ्गता','title_en' => 'Physical disability'],
        ];

        foreach ($disabilityTypes as $disabilityType) {
            DisabilityType::create($disabilityType);
        }
    }
}
