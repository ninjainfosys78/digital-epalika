<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('office_headers', function (Blueprint $table) {
            $table->string('card_font')->nullable()->after('font_size');
        });
    }

    public function down()
    {
        Schema::table('office_headers', function (Blueprint $table) {
            $table->dropColumn('card_font');
        });
    }
};
