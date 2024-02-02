<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('business_details', function (Blueprint $table) {
            $table->id();
            $table->string('submission_no')->nullable()->comment('सबमिशन नम्बर');
            $table->foreignId('fiscal_year_id')->nullable()->comment('आर्थिक बर्ष')->constrained()->nullOnDelete();
            $table->string('registration_no')->nullable()->comment('दर्ता नम्बर');
            $table->string('registration_date_ne')->nullable()->comment('दर्ता मिति बि. सं.');
            $table->string('registration_date_en')->nullable()->comment('दर्ता मिति ई. सं.');
            $table->string('name')->comment('व्यवसायको नाम');
            $table->string('name_en')->comment('व्यवसायको नाम(अंग्रेजीमा)');
            $table->string('address')->comment('ठेगाना');
            $table->string('address_en')->comment('ठेगाना(अंग्रेजीमा)');
            $table->text('purpose')->nullable()->comment('उद्देश्य');
            $table->foreignId('province_id')->nullable()->comment('प्रदेश')->constrained();
            $table->foreignId('district_id')->nullable()->comment('जिल्ला')->constrained();
            $table->foreignId('local_body_id')->nullable()->comment('पालिका')->constrained();
            $table->string('ward_no')->nullable()->comment('वडा नं');
            $table->string('way')->nullable()->comment('मार्ग');
            $table->string('tole')->nullable()->comment('गाउ/टोल');
            $table->foreignId('business_nature_id')->nullable()->comment('व्यवसायको प्रकृति')->constrained();
            $table->foreignId('object_transaction_id')->nullable()->comment('व्यवसायको कारोबार गर्ने मुख्य सेवा वा बस्तु')->constrained();
            $table->double('working_capital', 12, 2)->nullable()->default(0)->comment('चालु पूँजी');
            $table->double('fixed_capital', 12, 2)->nullable()->default(0)->comment('स्थिर पूँजी');
            $table->double('investment', 12, 2)->default(0)->comment('पूँजीगत लगानी');
            $table->boolean('is_rent')->default(0);
            $table->string('house_owner_name')->nullable()->comment('घर मालिकको नाम');
            $table->string('house_owner_phone')->nullable()->comment('घर मालिकको फोन');
            $table->string('house_owner_address')->nullable()->comment('घर मालिकको ठेगाना');
            $table->string('house_owner_monthly_rent')->nullable()->comment('घर मालिक मासिक भाडा');
            $table->string('length')->nullable()->comment('लम्बाई');
            $table->string('width')->nullable()->comment('चौडाई');
            $table->string('application_date')->nullable()->comment('आवेदन मिति बि. सं.');
            $table->string('application_date_en')->nullable()->comment('आवेदन मिति ई. सं.');
            $table->string('rent_agreement')->nullable()->comment('भाडा सम्झौता');
            $table->string('land_ownership_certificate')->nullable()->comment('आफ्नै घर जग्गा भए जग्गा धनि प्रमाणपत्र');
            $table->string('ward_recommendation')->nullable()->comment('वार्ड सिफारिस');
            $table->string('embassy_document')->nullable()->comment('राजदूतावासको कागजात');
            $table->string('registration_document')->nullable()->comment('दर्ता प्रमाणपत्र');
            $table->string('license')->nullable()->comment('इजाजत पत्र');
            $table->string('tax_document')->nullable()->comment('कर तिरेको प्रमाणपत्र');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_details');
    }
};
