<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_year_id')->constrained()->cascadeOnDelete();
            $table->integer('dispatch_no')->comment('चलानी नं.');
            $table->string('prefix')->nullable();
            $table->string('dispatch_date')->nullable()->comment('चलानी मिति');
            $table->date('en_dispatch_date')->nullable()->comment('चलानी मिति ई.सं.');
            $table->string('letter_number')->nullable()->comment('पत्र संख्या');
            $table->string('letter_date')->nullable()->comment('पत्र मिति');
            $table->date('en_letter_date')->nullable()->comment('पत्र मिति ई.सं.');
            $table->string('subject')->nullable()->comment('विषय');
            $table->string('receiver_name')->nullable()->comment('पाउने कार्यालयको नाम');
            $table->string('receiver_address')->nullable()->comment('पाउने कार्यालयको ठेगाना');
            $table->string('receiver_contact')->nullable()->comment('हुलाक/ र.न./इमेल');
            $table->text('remarks')->nullable()->comment('कैफियत');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dispatches');
    }
};
