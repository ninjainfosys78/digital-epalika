<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->foreignId('fiscal_year_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->dropConstrainedForeignId('fiscal_year_id');
        });
    }
};
