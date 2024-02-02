<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained('sectors')->onDelete('cascade');
            $table->string('ward_no');
            $table->string('title');
            $table->double('rate', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('places');
    }
};
