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
        Schema::table('farmers', function (Blueprint $table) {
            $table->foreignId('farmer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('relationship_id')->nullable()->constrained()->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('farmers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('farmer_id');
            $table->dropConstrainedForeignId('relationship_id');
        });
    }
};
