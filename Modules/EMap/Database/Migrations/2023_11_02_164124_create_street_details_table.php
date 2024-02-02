<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('street_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('setback')->nullable();
            $table->string('street_code')->nullable();
            $table->string('condition')->nullable();
            $table->string('wards')->nullable();
            $table->string('right_of_way')->nullable();
            $table->string('width')->nullable();
            $table->string('road_type')->nullable();
            $table->json('coordinates')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('street_details');
    }
};
