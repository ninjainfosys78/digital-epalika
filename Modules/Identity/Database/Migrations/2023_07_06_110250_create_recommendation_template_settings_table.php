<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('recommendation_template_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_hospital_detail_required')->default(1);
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recommendation_template_settings');
    }
};
