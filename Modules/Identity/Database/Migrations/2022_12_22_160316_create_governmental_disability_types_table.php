<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('governmental_disability_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_en');
            $table->integer('position');
            $table->string('color');
            $table->string('category')->nullable();
            $table->string('header_color')->nullable();
            $table->string('font_color')->nullable();
            $table->string('raven_background')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('governmental_disability_types');
    }
};
