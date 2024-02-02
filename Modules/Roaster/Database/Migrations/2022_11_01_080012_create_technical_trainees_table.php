<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('technical_trainees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name')->comment(' पुरा नाम');
            $table->string('photo');
            $table->foreignId('designation_id')->nullable()->comment('पद')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('department_id')->nullable()->comment('समुह')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('service_time')->nullable()->comment('सेवा अवधि');
            $table->string('label')->nullable()->comment('तह');
            $table->string('education_qualification')->nullable()->comment('शैक्षिक योग्यता');
            $table->foreignId('province_id')->nullable()->comment('प्रदेश')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('district_id')->nullable()->comment('जिल्ला')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('local_body_id')->nullable()->comment('पालिका')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->integer('ward_no')->nullable()->comment('वार्ड');
            $table->string('tole')->nullable()->comment('टोल');
            $table->string('contact_no')->comment('सम्पर्क नं.');
            $table->string('email')->nullable()->comment('ईमेल');
            $table->string('responsibility')->nullable()->comment('जिम्मेवारी');
            $table->string('training')->nullable()->comment('प्रशिक्षण');
            $table->string('hobby')->nullable()->comment('रुची');
            $table->string('excellence')->nullable()->comment('उत्कृष्टता');
            $table->text('learning_subject')->nullable();
            $table->text('expectation')->nullable()->comment('अपेक्षा');
            $table->string('office_name')->nullable()->comment('कार्यालयको नाम');
            $table->string('office_address')->nullable()->comment('कार्यालयको ठेगाना');
            $table->string('office_phone')->nullable()->comment('कार्यालयको फोन नम्बर');
            $table->string('office_email')->nullable()->comment('कार्यालयको इमेल');
            $table->string('nomination_letter')->nullable();
            $table->string('recommendation_letter')->nullable();
            $table->string('select')->nullable()->comment('छनोट');
            $table->string('reference_id')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('technical_trainees');
    }
};
