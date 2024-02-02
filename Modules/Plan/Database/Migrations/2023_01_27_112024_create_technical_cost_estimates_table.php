<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('technical_cost_estimates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('detail')->comment('विवरण');
            $table->double('quantity', 12, 2)->default(0)->comment('परिमाण');
            $table->foreignId('unit_id')->nullable()->comment('इकाइ')->constrained();
            $table->double('rate', 12, 2)->default(0)->comment('दर');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('technical_cost_estimates');
    }
};
