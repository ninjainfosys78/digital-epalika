<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('material_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_rate_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('unit_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('activity_no')->nullable();
            $table->string('remarks')->nullable();
            $table->foreignId('fiscal_year_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('material_collections');
    }
};
