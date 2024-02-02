<?php

namespace Database\Seeders;

use App\Models\Settings\LetterHead;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\View;

class LetterHeadTableSeeder extends Seeder
{
    public function run()
    {
        LetterHead::truncate();

        LetterHead::create([
            'header' => (string)View::make('admin.global.letter_head.default_header'),
            'header_en' => (string)View::make('admin.global.letter_head.default_header'),
            'letter_head' => (string)View::make('admin.global.letter_head.default_letter_head'),
        ]);
    }
}
