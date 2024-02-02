<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('feature_activations', function (Blueprint $table) {
            $table->id();
            $table->string('feature_name_ne');
            $table->string('feature_name_en');
            $table->string('feature_key')->unique();
            $table->boolean('feature_status')->default(0);
            $table->string('feature_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feature_activations');
    }
};
