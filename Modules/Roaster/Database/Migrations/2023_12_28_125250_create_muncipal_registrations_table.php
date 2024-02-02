<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('muncipal_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainee_user_detail_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('palika_reg_no')->nullable();
            $table->string('reg_date')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('muncipal_registrations');
    }
};
