<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('map_settings', function (Blueprint $table) {
            $table->id();
            $table->longText('map_request_form_format')->nullable();
            $table->foreignId('land_measurement_id')->nullable()->constrained('types')->nullOnDelete();
            $table->foreignId('land_measurement_standard_id')->nullable()->constrained('units')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('map_settings');
    }
};
