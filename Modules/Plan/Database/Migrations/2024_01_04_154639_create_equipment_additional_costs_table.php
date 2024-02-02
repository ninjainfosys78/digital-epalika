<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('equipment_additional_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('fiscal_year_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('unit_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('rate');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipment_additional_costs');
    }
};
