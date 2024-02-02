<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('registered_businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_detail_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('registration_no')->nullable()->comment('दर्ता नम्बर');
            $table->string('business_name')->nullable()->comment('नाम');
            $table->string('registration_date')->nullable()->comment('दर्ता मिति');
            $table->boolean('is_active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registered_businesses');
    }
};
