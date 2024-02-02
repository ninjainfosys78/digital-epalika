<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('applicant_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_apply_id')->constrained()->cascadeOnDelete();
            $table->string('applicant_type')->nullable()->comment('आवेदक प्रकार');
            $table->string('relation_with_owner')->nullable()->comment('मालिकसँग सम्बन्ध');
            $table->string('name')->nullable()->comment('नाम');
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('father_name')->nullable()->comment('बुवाको नाम ');
            $table->string('address')->nullable()->comment('ठेगाना ');
            $table->foreignId('citizenship_issue_district_id')->nullable()->constrained('districts');
            $table->string('citizenship_no')->nullable()->comment('नागरिकता नं ');
            $table->string('citizenship_issue_date')->nullable()->comment('नागरिकता जारी मिति ');
            $table->string('application_date')->nullable()->comment('निबेदन मिति ');
            $table->string('signature')->nullable()->comment('हस्ताक्षर ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applicant_details');
    }
};
