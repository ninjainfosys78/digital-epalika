<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('disability_prints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disability_identity_card_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('employee_signature_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('title');
            $table->string('date');
            $table->timestamp('date_ad');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('disability_prints');
    }
};
