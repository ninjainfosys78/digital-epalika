<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('sipharish_creates', function (Blueprint $table) {
            $table->foreignId('personal_detail_id')->constrained('personal_details')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::table('sipharish_created', function (Blueprint $table) {
            $table->dropConstrainedForeignId('personal_detail_id');
        });
    }
};
