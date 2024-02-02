<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('organization_details', function (Blueprint $table) {
            $table->id();
            $table->string('org_name_ne');
            $table->string('org_name_en')->nullable();
            $table->string('org_email')->nullable();
            $table->string('org_contact')->nullable();
            $table->string('org_registration_no')->nullable();
            $table->string('org_registration_document')->nullable();
            $table->string('org_pan_no')->nullable();
            $table->string('org_pan_document')->nullable();
            $table->string('logo')->nullable();

            $table->foreignId('province_id')->nullable()->constrained('provinces');
            $table->foreignId('district_id')->nullable()->constrained('districts');
            $table->foreignId('local_body_id')->nullable()->constrained('local_bodies');
            $table->integer('ward')->nullable();
            $table->string('tole')->nullable();

            $table->foreignId('organization_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organization_details');
    }
};
