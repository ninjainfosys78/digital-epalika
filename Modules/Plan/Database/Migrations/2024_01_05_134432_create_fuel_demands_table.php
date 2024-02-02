<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('fuel_demands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fuel_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('equipment_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fuel_demands');
    }
};
