<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->string('notation')->nullable();
            $table->string('notation_ne')->nullable();
        });
    }

    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'notation', 'notation_ne']);
        });
    }
};
