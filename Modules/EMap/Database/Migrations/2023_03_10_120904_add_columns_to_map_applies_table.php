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
            $table->string('sent_to_organization')->default('Unseen');
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
            $table->dropColumn('sent_to_organization');
        });
    }
};
