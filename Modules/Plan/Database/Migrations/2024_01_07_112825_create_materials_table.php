<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_type_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('unit_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('title');
            $table->string('density');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materials');
    }
};
