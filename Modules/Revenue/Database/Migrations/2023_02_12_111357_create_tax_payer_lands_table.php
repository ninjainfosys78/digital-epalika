<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('tax_payer_lands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tax_payer_id')->constrained('tax_payers')->onDelete('cascade');
            $table->string('plot_no')->nullable();
            $table->string('former_ward')->nullable();
            $table->string('former_vdc')->nullable();
            $table->string('ward_no')->nullable();
            $table->string('area')->nullable();
            $table->foreignId('sector_id')->constrained('sectors')->onDelete('cascade');
            $table->foreignId('place_id')->constrained('places')->onDelete('cascade');
            $table->string('land_address')->nullable();
            $table->string('land_use')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tax_payer_lands');
    }
};
