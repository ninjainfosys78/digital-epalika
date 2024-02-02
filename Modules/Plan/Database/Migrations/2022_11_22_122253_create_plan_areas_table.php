<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('plan_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_area_id')->nullable()->comment('योजना क्षेत्र')->constrained()->cascadeOnDelete();
            $table->string('area_name')->comment('क्षेत्रको नाम');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plan_areas');
    }
};
