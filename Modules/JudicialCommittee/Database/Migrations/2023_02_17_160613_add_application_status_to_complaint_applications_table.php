<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::table('complaint_applications', function (Blueprint $table) {
            $table->string('application_status');
        });
    }

    public function down()
    {
        Schema::table('complaint_applications', function (Blueprint $table) {
            $table->dropColumn('application_status');
        });
    }
};
