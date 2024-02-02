<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('emergency_numbers', function (Blueprint $table) {
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('address')->nullable();
        });
    }

    public function down()
    {
        Schema::table('emergency_numbers', function (Blueprint $table) {
            $table->dropColumn(['latitude',
                'longitude',
                'contact_person_name',
                'address',]);
        });
    }
};
