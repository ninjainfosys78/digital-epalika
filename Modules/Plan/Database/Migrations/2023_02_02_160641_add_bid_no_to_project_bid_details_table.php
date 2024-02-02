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
        Schema::table('project_bid_details', function (Blueprint $table) {
            $table->string('bid_no')->nullable()->comment('बोलपत्र नं.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_bid_details', function (Blueprint $table) {
            $table->dropColumn('bid_no');
        });
    }
};
