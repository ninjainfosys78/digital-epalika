<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('plan_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_level_id')->nullable()->comment('योजना स्तर')->constrained()->cascadeOnDelete();
            $table->string('level_name')->comment('स्तर नाम');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plan_levels');
    }
};
