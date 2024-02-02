<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('map_fees', function (Blueprint $table) {
            $table->id();
            $table->string('storey');
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->double('rate', 12, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('map_fees');
    }
};
