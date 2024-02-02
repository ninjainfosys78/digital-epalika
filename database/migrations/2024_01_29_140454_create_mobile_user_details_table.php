<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mobile_user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobile_user_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('province_id')->nullable()->constrained('provinces');
            $table->foreignId('district_id')->nullable()->constrained('districts');
            $table->foreignId('local_body_id')->nullable()->constrained('local_bodies');
            $table->integer('ward_no')->nullable();
            $table->string('tole')->nullable();

            $table->foreignId('temporary_province_id')->nullable()->constrained('provinces');
            $table->foreignId('temporary_district_id')->nullable()->constrained('districts');
            $table->foreignId('temporary_local_body_id')->nullable()->constrained('local_bodies');
            $table->integer('temporary_ward')->nullable();
            $table->string('temporary_tole')->nullable();

            $table->string('citizenship_no')->nullable();
            $table->foreignId('citizenship_issued_district')->nullable()->constrained('districts');
            $table->string('citizenship_issued_date')->nullable();
            $table->string('citizenship_front')->nullable();
            $table->string('citizenship_back')->nullable();
            $table->string('nec_no')->nullable();
            $table->string('nec_certificate')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mobile_user_details');
    }
};
