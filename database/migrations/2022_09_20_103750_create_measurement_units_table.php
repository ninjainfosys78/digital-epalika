<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('measurement_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->comment('टाइपको आईडी')->constrained();
            $table->string('title')->comment('शीर्षक');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('measurement_units');
    }
};
