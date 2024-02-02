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
        Schema::table('map_applies', function (Blueprint $table) {
            $table->string('file_code')->nullable();
            $table->integer('number')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('map_applies', function (Blueprint $table) {
            $table->dropColumn('file_code', 'number');
        });
    }
};
