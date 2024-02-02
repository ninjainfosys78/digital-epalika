<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('list_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_year_id')->comment('आर्थिक वर्ष')->constrained();
            $table->string('registration_no')->comment('दर्ता नं.');
            $table->string('applicant_type')->nullable()->comment('आवेदक प्रकार');
            $table->string('name')->nullable()->comment('नाम');
            $table->string('address')->nullable()->comment('ठेगाना');
            $table->string('mailing_address')->nullable()->comment('पत्राचार ठेगाना');
            $table->string('main_person')->nullable()->comment('मुख्य व्यक्ति');
            $table->string('telephone')->nullable()->comment('टेलिफोन');
            $table->string('mobile_no')->nullable()->comment('फोन नम्बर');
            $table->string('application_photo')->nullable()->comment('आवेदन फोटो');
            $table->string('registration_certificate')->nullable()->comment('दर्ता प्रमाणपत्र');
            $table->string('pan_photo')->nullable()->comment('प्यान फोटो');
            $table->string('tax_payment_certificate')->nullable()->comment('कर भुक्तानी प्रमाणपत्र');
            $table->string('license_photo')->nullable()->comment('लाइसेन्स फोटो');
            $table->string('business_nature')->nullable()->comment('व्यापार प्रकृति');
            $table->longText('business_nature_description')->nullable()->comment('व्यापार प्रकृति विवरण');
            $table->string('date')->nullable()->comment('मिति');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('list_registrations');
    }
};
