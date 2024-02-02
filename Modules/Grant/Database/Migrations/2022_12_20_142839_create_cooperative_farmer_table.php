<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('cooperative_farmer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cooperative_id')->constrained();
            $table->foreignId('farmer_id')->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cooperative_farmer');
    }
};
