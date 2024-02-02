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
        Schema::table('sipharish_creates', function (Blueprint $table) {
            $table->foreignId('mobile_user_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sipharish_creates', function (Blueprint $table) {
            $table->dropConstrainedForeignId('mobile_user_id');
        });
    }
};
