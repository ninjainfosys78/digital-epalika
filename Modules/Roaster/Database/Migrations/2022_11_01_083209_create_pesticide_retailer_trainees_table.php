<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('pesticide_retailer_trainees', function (Blueprint $table) {
            $table->id();
            $table->string('reference_id')->unique()->comment('सन्दर्भ आईडी');
            $table->string('full_name')->comment('पुरा नाम');
            $table->foreignId('province_id')->comment('प्रदेश')->constrained()->onDelete('cascade')->onUpdate('no action');
            $table->foreignId('district_id')->comment('जिल्ला')->constrained()->onDelete('cascade')->onUpdate('no action');
            $table->foreignId('local_body_id')->comment('पालिका')->constrained()->onDelete('cascade')->onUpdate('no action');
            $table->integer('ward_no')->nullable()->comment('वार्ड');
            $table->string('tole')->nullable()->comment('टोल');
            $table->string('citizenship_no')->comment('नागरिकता नं.');
            $table->string('gender')->comment('लिङ्ग');
            $table->string('phone_no')->nullable()->comment('फोन नं.');
            $table->string('email_id')->nullable()->comment('ईमेल');
            $table->string('qualification')->nullable()->comment('योग्यता');
            $table->string('current_profession')->nullable()->comment('वर्तमान पेशा');
            $table->string('photo')->nullable();
            $table->string('mark_sheet')->nullable();
            $table->string('citizenship_front');
            $table->string('citizenship_back')->nullable();
            $table->string('other_training')->nullable();
            $table->boolean('select')->default(0)->comment('छनोट');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesticide_retailer_trainees');
    }
};
