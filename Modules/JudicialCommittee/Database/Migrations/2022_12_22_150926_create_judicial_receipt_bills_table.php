<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('judicial_receipt_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_application_id')->constrained()->cascadeOnDelete();
            $table->string('bill_no')->comment('बिल नम्बर');
            $table->string('entry_person')->nullable()->comment('प्रवेश गर्ने व्यक्ति');
            $table->double('amount', 12, 2)->default(0)->comment('रकम');
            $table->string('bill_date')->comment('बिल मिति');
            $table->string('file')->nullable()->comment('फाइल');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('judicial_receipt_bills');
    }
};
