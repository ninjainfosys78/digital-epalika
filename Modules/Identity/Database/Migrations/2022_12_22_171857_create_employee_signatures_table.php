<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('employee_signatures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->string('designation_en')->nullable();
            $table->string('designation')->nullable();
            $table->string('pin')->nullable();
            $table->string('black_signature')->nullable();
            $table->string('red_signature')->nullable();
            $table->string('stamp')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_signatures');
    }
};
