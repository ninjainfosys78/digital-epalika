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
        Schema::table('sipharis_form_fields', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->foreignId('sipharis_form_field_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sipharis_form_fields', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropConstrainedForeignId('sipharis_form_field_id');
        });
    }
};
