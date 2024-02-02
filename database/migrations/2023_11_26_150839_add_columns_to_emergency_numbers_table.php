<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('emergency_numbers', function (Blueprint $table) {
            $table->foreignId('emergency_category_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
        });
    }

    public function down()
    {
        Schema::table('emergency_numbers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('emergency_category_id');
        });
    }
};
