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
            $table->foreignId('sipharis_signature_id')->nullable()->constrained('sipharis_signature_details')->onDelete('cascade');

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

        });
    }
};
