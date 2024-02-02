<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('criteria_detail_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_use_area_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('area');
            $table->string('sign');
            $table->string('gcr');
            $table->string('far');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('criteria_detail_settings');
    }
};
