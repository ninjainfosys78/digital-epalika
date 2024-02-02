<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('crew_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('labour_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('equipment_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crew_rates');
    }
};
