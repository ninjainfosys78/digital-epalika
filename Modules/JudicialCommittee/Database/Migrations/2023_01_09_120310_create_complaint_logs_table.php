<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('complaint_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_application_id')->nullable()->constrained()->cascadeOnDelete();
            $table->nullableMorphs('model');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complaint_logs');
    }
};
