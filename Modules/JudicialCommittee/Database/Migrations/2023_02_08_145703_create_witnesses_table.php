<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('witnesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_application_id')->constrained()->cascadeOnDelete();
            $table->string('name')->comment('नाम');
            $table->integer('age')->nullable()->comment('उमेर');
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('address')->nullable()->comment('ठेगाना');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('witnesses');
    }
};
