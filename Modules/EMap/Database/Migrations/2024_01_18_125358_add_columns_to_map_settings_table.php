<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('map_settings', function (Blueprint $table) {
            $table->longText('muchulka_after_complietion')->nullable();
            $table->longText('muchulka_before_complietion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('map_settings', function (Blueprint $table) {
            $table->dropColumn('muchulka_after_complietion', 'muchulka_before_complietion');
        });
    }
};
