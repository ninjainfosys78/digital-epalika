<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('unit_conversions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversion_from')->comment('बाट रूपान्तरण')->constrained('units');
            $table->foreignId('conversion_to')->comment('मा रूपान्तरण')->constrained('units');
            $table->string('rate')->default(1)->comment('दर');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('unit_conversions');
    }
};
