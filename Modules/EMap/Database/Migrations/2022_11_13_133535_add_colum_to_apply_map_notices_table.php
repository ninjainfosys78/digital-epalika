<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('apply_map_notices', function (Blueprint $table) {
            $table->timestamp('sent_to_admin_at')->nullable()->comment('admin लाई पठाएको मिति ');
        });
    }

    public function down()
    {
        Schema::table('apply_map_notices', function (Blueprint $table) {
            $table->dropColumn('sent_to_admin_at');
        });
    }
};
