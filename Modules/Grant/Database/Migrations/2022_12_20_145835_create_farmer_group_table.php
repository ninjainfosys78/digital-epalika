<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('farmer_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->constrained();
            $table->foreignId('group_id')->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('farmer_group');
    }
};
