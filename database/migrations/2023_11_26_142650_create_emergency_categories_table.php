<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('emergency_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emergency_categories');
    }
};
