<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('business_renews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_year_id')->comment('आर्थिक बर्ष')->constrained()->cascadeOnDelete();
            $table->foreignId('business_detail_id')->constrained()->cascadeOnDelete();
            $table->string('business_renew_date')->comment('नबिकरण मिति वि.सं.');
            $table->string('business_renew_date_en')->comment('नबिकरण मिति ई.सं.');
            $table->string('date_to_be_maintained')->comment('नबिकरण कायम रहने मिति वि.सं.');
            $table->string('date_to_be_maintained_en')->comment('नबिकरण कायम रहने मिति ई.सं.');
            $table->double('renew_amount', 14, 2)->comment('नबिकरण रकम');
            $table->double('penalty_amount', 14, 2)->default(0)->comment('जरिवाना रकम');
            $table->string('payment_receipt')->comment('बिल नं.');
            $table->string('payment_receipt_date')->comment('रसिद मिति वि.सं.');
            $table->string('payment_receipt_date_en')->comment('रसिद मिति ई.सं.');
            $table->integer('reg_no')->default(0);
            $table->string('registration_no');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_renews');
    }
};
