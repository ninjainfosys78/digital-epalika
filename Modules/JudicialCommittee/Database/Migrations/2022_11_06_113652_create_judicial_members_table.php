<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('judicial_members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('नाम');
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('email')->nullable()->comment('इमेल');
            $table->string('designation')->nullable()->comment('पद');
            $table->string('address')->nullable()->comment('ठेगाना');
            $table->integer('position')->comment('स्थान');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('judicial_members');
    }
};
