<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('recommendation_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_chairman_id')->nullable()->constrained('employees')->nullOnDelete()->onUpdate('no action');
            $table->foreignId('ward_secretary_id')->nullable()->constrained('employees')->nullOnDelete()->onUpdate('no action');
            $table->foreignId('user_id')->nullable()->constrained('employees')->nullOnDelete()->onUpdate('no action');
            $table->string('ward_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recommendation_settings');
    }
};
