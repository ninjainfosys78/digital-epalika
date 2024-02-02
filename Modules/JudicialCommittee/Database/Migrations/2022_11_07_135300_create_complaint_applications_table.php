<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('complaint_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_year_id')->comment('आर्थिक बर्ष')->constrained();
            $table->string('submission_no')->comment('सबमिशन नं.');
            $table->string('registration_no')->nullable()->comment('दर्ता नम्बर');
            $table->foreignId('lawsuit_nature_id')->nullable()->comment('मुद्दा प्रकृति')->constrained();
            $table->string('subject')->comment('विषय');
            $table->string('complaint_detail')->nullable()->comment('विवरण');
            $table->string('date')->nullable()->comment('मिति बि.सं.');
            $table->date('en_date')->nullable()->comment('मिति इ.सं.');
            $table->string('applicant_name')->nullable()->comment('निवेदकको नाम');
            $table->string('applicant_phone')->nullable()->comment('निवेदकको फोन');
            $table->string('applicant_address')->nullable()->comment('निवेदकको ठेगाना');
            $table->string('applicant_signature')->nullable()->comment('निवेदकको हस्ताक्षर');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complaint_applications');
    }
};
