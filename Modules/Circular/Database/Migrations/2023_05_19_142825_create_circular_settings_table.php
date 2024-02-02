<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('circular_settings', function (Blueprint $table) {
            $table->id();
            $table->string('registration_prefix');
            $table->string('dispatch_prefix');
            $table->integer('registration_number')->default(0);
            $table->integer('dispatch_number')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('circular_settings');
    }
};
