<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('शिर्षक');
            $table->string('level')->comment('तह');
            $table->string('duration')->nullable()->comment('अवधि');
            $table->text('content')->nullable()->comment('सामग्री');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
