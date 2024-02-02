<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('house_owner_old_map', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_owner_id')->constrained()->cascadeOnDelete();
            $table->foreignId('old_map_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('house_owner_old_map');
    }
};
