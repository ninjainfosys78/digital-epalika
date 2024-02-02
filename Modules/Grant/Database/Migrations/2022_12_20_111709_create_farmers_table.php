<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->comment('कृषक आइडी')->unique();
            $table->string('first_name')->comment('अगाडीको नाम');
            $table->string('middle_name')->comment('बिचको नाम')->nullable();
            $table->string('last_name')->comment('थर');
            $table->string('photo')->comment('फोटो')->nullable();
            $table->string('gender')->comment('लिङ्ग');
            $table->string('marital_status')->comment('वैवाहिक स्थिति');
            $table->string('spouse_name')->comment('दम्पतिको नाम')->nullable();
            $table->string('father_name')->comment('बुबाको नाम');
            $table->string('grandfather_name')->comment('हजुरबुबाको नाम');
            $table->string('citizenship_no')->comment('नागरिकता नं');
            $table->string('farmer_id_card_no')->comment('किसान परिचयपत्र नं')->nullable();
            $table->string('national_id_card_no')->comment('राष्ट्रिय परिचयपत्र नं')->nullable();
            $table->string('phone_no')->comment('फोन नं');
            $table->foreignId('province_id')->comment('प्रदेश')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('district_id')->comment('जिल्ला')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('local_body_id')->comment('पालिका')->nullable()->constrained()->nullOnDelete();
            $table->integer('ward_no')->comment('वार्ड')->nullable();
            $table->string('village')->comment('गाउ')->nullable();
            $table->string('tole')->comment('टोल')->nullable();
            $table->foreignId('user_id')->comment('डाटा हाल्ने व्यक्ति')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('farmers');
    }
};
