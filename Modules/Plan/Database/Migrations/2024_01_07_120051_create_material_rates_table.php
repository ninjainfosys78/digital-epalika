<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('material_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('fiscal_year_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->boolean('is_vat_included')->default(0);
            $table->boolean('is_vat_needed')->default(0);
            $table->string('referance_no')->nullable();
            $table->string('royalty')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('material_rates');
    }
};
