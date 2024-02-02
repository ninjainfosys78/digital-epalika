<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::table('apply_map_notices', function (Blueprint $table) {
            $table->string('type')->default('Unseen');
        });
    }


    public function down()
    {
        Schema::table('apply_map_notices', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
