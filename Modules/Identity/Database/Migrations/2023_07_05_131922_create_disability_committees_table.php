<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('disability_committees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('नाम');
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('designation')->nullable()->comment('पद');
            $table->integer('position')->comment('मर्यादाक्रम');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('disability_committees');
    }
};
