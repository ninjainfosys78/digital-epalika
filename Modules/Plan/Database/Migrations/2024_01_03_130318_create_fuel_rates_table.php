<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('fuel_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fuel_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('rate');
            $table->boolean('has_included_vat')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fuel_rates');
    }
};
