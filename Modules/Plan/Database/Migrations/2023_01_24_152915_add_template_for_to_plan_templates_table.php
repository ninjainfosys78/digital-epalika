<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::table('plan_templates', function (Blueprint $table) {
            $table->string('template_for')->nullable()->after('type');
        });
    }

    public function down()
    {
        Schema::table('plan_templates', function (Blueprint $table) {
            $table->dropColumn('template_for');
        });
    }
};
