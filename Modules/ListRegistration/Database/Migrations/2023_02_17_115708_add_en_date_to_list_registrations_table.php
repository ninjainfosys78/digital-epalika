<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::table('list_registrations', function (Blueprint $table) {
            $table->date('en_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('list_registrations', function (Blueprint $table) {
            $table->dropColumn('en_date');
        });
    }
};
