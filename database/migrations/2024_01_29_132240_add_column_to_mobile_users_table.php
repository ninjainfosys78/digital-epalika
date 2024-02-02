<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mobile_users', function (Blueprint $table) {
            $table->string('tax_payer_id')->nullable();
            $table->string('approved_at')->nullable();
            $table->string('avatar')->nullable();
        });
    }

    public function down()
    {
        Schema::table('mobile_users', function (Blueprint $table) {
            $table->dropColumn([
                'tax_prayer_id',
                'approved_at',
                'avatar',
            ]);
        });
    }
};
