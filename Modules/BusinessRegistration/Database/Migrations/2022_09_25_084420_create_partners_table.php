<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_detail_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name')->comment('नाम');
            $table->string('name_en')->comment('नाम अंग्रेजीमा');
            $table->string('citizenship_no')->comment('नागरिकता नम्बर');
            $table->string('issue_date')->comment('जारि मिति');
            $table->foreignId('issue_district_id')->nullable()->comment('नागरिकता जारी जिल्ला')->constrained('districts')->nullOnDelete()->onUpdate('no action');
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('email')->nullable()->comment('इमेल');
            $table->foreignId('province_id')->nullable()->comment('प्रदेश')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('district_id')->nullable()->comment('जिल्ला')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('local_body_id')->nullable()->comment('पालिका')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('ward_no')->nullable()->comment('वडा नं');
            $table->string('way')->nullable()->comment('मार्ग');
            $table->string('tole')->nullable()->comment('टोल');
            $table->string('house_no')->nullable()->comment('घर नम्बर');
            $table->string('account_no')->nullable()->comment('व्यक्तिगत स्थाई लेखा नम्बर');
            $table->string('national_card_no')->nullable()->comment('राष्ट्रियता परिचयपत्र नम्बर');
            $table->string('gender')->nullable()->comment('लिङ्ग');
            $table->string('education_qualification')->nullable()->comment('शैक्षिक योग्यता');
            $table->string('occupation')->nullable()->comment('मुख्य पेशा');
            $table->string('father_name')->nullable()->comment('बुबाको नाम');
            $table->string('grandfather_name')->nullable()->comment('हजुरबुबाको नाम');
            $table->string('photo')->nullable()->comment('पासपोर्ट साइजको फोटो');
            $table->string('signature')->nullable()->comment('हस्ताक्षर');
            $table->string('citizenship_front')->nullable()->comment('नागरिकता (आगाडी)');
            $table->string('citizenship_back')->nullable()->comment('नागरिकता (पछाडी)');
            $table->integer('position');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partners');
    }
};
