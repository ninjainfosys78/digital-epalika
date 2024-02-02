<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->foreignId('fiscal_year_id')->comment('आर्थिक वर्ष')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
        });
    }

    public function down()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('fiscal_year_id');
        });
    }
};
