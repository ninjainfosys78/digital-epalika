<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('enterprise_farmer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enterprise_id')->constrained();
            $table->foreignId('farmer_id')->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enterprise_farmer');
    }
};
