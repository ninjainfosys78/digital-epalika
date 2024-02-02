<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('grievance_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('नाम');
            $table->string('address')->nullable()->comment('ठेगाना');
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('email')->comment('इमेल');
            $table->string('password')->nullable()->comment('पासवर्ड');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grievance_users');
    }
};
