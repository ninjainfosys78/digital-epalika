<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::table('benefited_member_details', function (Blueprint $table) {
            $table->integer('no_of_others')->nullable()->comment('अन्य संख्या');
        });
    }

    public function down()
    {
        Schema::table('benefited_member_details', function (Blueprint $table) {
            $table->dropColumn('no_of_others');
        });
    }
};
