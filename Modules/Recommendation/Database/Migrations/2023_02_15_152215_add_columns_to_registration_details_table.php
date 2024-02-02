<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::table('registration_details', function (Blueprint $table) {
            $table->integer('ward_no')->comment('वडा नं');
            $table->foreignId('fiscal_year_id')->nullable()->comment('आर्थिक वर्ष')->constrained()->nullOnDelete()->onUpdate('no action');
        });
    }


    public function down()
    {
        Schema::table('registration_details', function (Blueprint $table) {
            $table->dropConstrainedForeignId('fiscal_year_id');
            $table->dropColumn('ward_no');
        });
    }
};
