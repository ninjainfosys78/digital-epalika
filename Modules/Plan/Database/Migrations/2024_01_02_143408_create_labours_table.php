<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('labours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('unit_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('labours');
    }
};
