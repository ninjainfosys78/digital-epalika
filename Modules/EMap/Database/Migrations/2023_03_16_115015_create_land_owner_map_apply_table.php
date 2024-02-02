<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('land_owner_map_apply', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_owner_id')->constrained()->cascadeOnDelete();
            $table->foreignId('map_apply_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('land_owner_map_apply');
    }
};
