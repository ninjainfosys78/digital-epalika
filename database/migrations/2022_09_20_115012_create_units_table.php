<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->comment('प्रकार आईडी')->constrained()->cascadeOnDelete();
            $table->foreignId('measurement_unit_id')->comment('मापन एकाइ आईडी')->constrained()->cascadeOnDelete();
            $table->string('title')->comment('शीर्षक');
            $table->integer('position')->nullable()->comment('स्थान ');
            $table->integer('is_smallest')->default(0)->comment('सबैभन्दा सानो छ?');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
};
