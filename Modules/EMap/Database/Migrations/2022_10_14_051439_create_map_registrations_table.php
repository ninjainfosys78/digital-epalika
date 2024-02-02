<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('map_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_apply_id')->constrained()->cascadeOnDelete();
            $table->string('form_receipt')->nullable()->comment('फारम रसिद');
            $table->string('application_registration_fee')->nullable()->comment('आवेदन दर्ता फारम');
            $table->string('other')->nullable()->comment('अन्य ');
            $table->string('nepali_date')->nullable()->comment('नेपाली मिति ');
            $table->string('english_date')->nullable()->comment('अंग्रजी मिति ');
            $table->string('receipt_no')->nullable()->comment('रसिद नम्बर');
            $table->string('recipient')->nullable()->comment('प्राप्तकर्ता');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('map_registrations');
    }
};
