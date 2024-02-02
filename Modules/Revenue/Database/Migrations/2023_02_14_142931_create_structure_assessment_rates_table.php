<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('structure_assessment_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained('sectors')->onDelete('cascade');
            $table->foreignId('physical_structure_type_id')->constrained('physical_structure_types')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('usage')->nullable();
            $table->double('rate', 14, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('structure_assessment_rates');
    }
};
