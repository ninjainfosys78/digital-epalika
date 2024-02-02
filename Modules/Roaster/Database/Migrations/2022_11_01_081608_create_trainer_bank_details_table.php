<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('trainer_bank_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained()->cascadeOnDelete();
            $table->string('bank_name')->comment('बैंक नाम');
            $table->string('bank_branch')->comment('बैंक शाखा');
            $table->string('account_number')->comment('खाता नम्बर');
            $table->string('account_holder')->comment('खातावाला');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainer_bank_details');
    }
};
