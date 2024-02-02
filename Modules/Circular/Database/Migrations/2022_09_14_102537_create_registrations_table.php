<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_year_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->integer('registration_no')->comment('दर्ता नं.');
            $table->string('registration_date')->nullable()->comment('दर्ता मिति (वि.स.)');
            $table->date('en_registration_date')->nullable()->comment('दर्ता मिति (ई.सं.)');
            $table->string('letter_number')->nullable()->comment('पत्र संख्या');
            $table->date('en_letter_date')->nullable()->comment('पत्र मिति (ई.सं.)');
            $table->string('letter_date')->nullable()->comment('पत्र मिति');
            $table->string('sender_name')->nullable()->comment('पठाउने कार्यालयको नाम');
            $table->string('subject')->nullable()->comment('विषय');
            $table->string('receiver_name')->nullable()->comment('बुझिलिनेको नाम');
            $table->string('phone')->nullable()->comment('बुझिलिनेको फोन');
            $table->string('email')->nullable()->comment('बुझिलिनेको ई-मेल');
            $table->string('signature_image')->nullable()->comment('हस्ताक्षर');
            $table->string('date')->nullable()->comment('मिति');
            $table->string('status')->default('pending');
            $table->text('remarks')->nullable()->comment('कैफियत');
            $table->string('prefix')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registrations');
    }
};
