<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('criteria_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_apply_id')->constrained()->cascadeOnDelete();
            $table->string('detail')->nullable()->comment('विवरण ');
            $table->string('according_to_criteria')->nullable()->comment('मापदण्ड अनुसार');
            $table->string('according_to_map')->nullable()->comment('नक्सा अनुसार');
            $table->string('compliance')->nullable()->comment('अनुपालन');
            $table->text('remarks')->nullable()->comment('कैफियत ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('criteria_details');
    }
};
