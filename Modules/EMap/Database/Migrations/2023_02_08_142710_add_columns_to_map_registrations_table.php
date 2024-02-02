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
        Schema::table('map_registrations', function (Blueprint $table) {
            $table->double('amount', 12, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->string('tax_payer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('map_registrations', function (Blueprint $table) {
            $table->dropColumn('amount');
            $table->dropColumn('remarks');
            $table->dropColumn('tax_payer');
        });
    }
};
