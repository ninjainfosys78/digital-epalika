<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('office_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('नाम');
            $table->string('site_address')->nullable()->comment('साइट ठेगाना');
            $table->string('logo')->nullable()->comment('लोगो');
            $table->string('logo1')->nullable()->comment('लोगो1');
            $table->string('logo2')->nullable()->comment('लोगो2');
            $table->string('background_image')->nullable()->comment('पृष्ठभूमि छवि');
            $table->longText('introduction')->nullable()->comment('परिचय');
            $table->text('google_map')->nullable()->comment('गुगल नक्शा');
            $table->foreignId('province_id')->nullable()->comment('प्रदेश आईडी')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('district_id')->nullable()->comment('जिल्ला आईडी')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('local_body_id')->nullable()->comment('स्थानीय निकाय आईडी')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('fiscal_year_id')->nullable()->comment('आर्थिक वर्ष आईडी')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('ward_no')->nullable()->comment('वार्ड नं');
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('email')->nullable()->comment('इमेल');
            $table->text('website')->nullable()->comment('वेबसाइट');
            $table->text('facebook_link')->nullable()->comment('फेसबुक लिङ्क');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('office_settings');
    }
};
