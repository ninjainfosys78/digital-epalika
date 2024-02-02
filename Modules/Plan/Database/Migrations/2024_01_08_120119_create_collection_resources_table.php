<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('collection_resources', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('model');
            $table->string('collectable');
            $table->string('type'); //equipment/labour
            $table->string('quantity');
            $table->string('rate_type'); //enum: percent/flat
            $table->string('rate');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('collection_resources');
    }
};
