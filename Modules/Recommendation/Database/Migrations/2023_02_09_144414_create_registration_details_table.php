<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('registration_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('registration_no')->comment('दर्ता नं');
            $table->longText('recommendation_data')->nullable()->comment('डाटा');
            $table->foreignId('recommendation_category_id')->nullable()->comment('सिफारिस प्रकार')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('personal_detail_id')->nullable()->comment('व्यक्तिगत विवरण')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registration_details');
    }
};
