<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('name_ne');
            $table->string('name_en')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->default('male');
            $table->string('marital_status')->nullable();
            $table->string('father_name')->nullable();
            $table->string('grandfather_name')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('nec_no')->nullable();
            $table->string('nec_certificate')->nullable();

            $table->string('citizenship_no')->nullable();
            $table->foreignId('citizenship_issued_district')->nullable()->constrained('districts');
            $table->string('citizenship_issued_date')->nullable();
            $table->string('citizenship_front')->nullable();
            $table->string('citizenship_back')->nullable();

            $table->foreignId('permanent_province_id')->nullable()->constrained('provinces');
            $table->foreignId('permanent_district_id')->nullable()->constrained('districts');
            $table->foreignId('permanent_local_body_id')->nullable()->constrained('local_bodies');
            $table->integer('permanent_ward')->nullable();
            $table->string('permanent_tole')->nullable();

            $table->foreignId('temporary_province_id')->nullable()->constrained('provinces');
            $table->foreignId('temporary_district_id')->nullable()->constrained('districts');
            $table->foreignId('temporary_local_body_id')->nullable()->constrained('local_bodies');
            $table->integer('temporary_ward')->nullable();
            $table->string('temporary_tole')->nullable();

            $table->foreignId('organization_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_details');
    }
};
