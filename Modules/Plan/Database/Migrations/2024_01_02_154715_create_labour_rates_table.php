<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('labour_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_year_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('labour_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('rate');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('labour_rates');
    }
};
