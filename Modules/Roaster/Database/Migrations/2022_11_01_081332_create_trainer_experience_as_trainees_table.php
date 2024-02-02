<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('trainer_experience_as_trainees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained()->cascadeOnDelete();
            $table->text('subject')->comment('बिषय');
            $table->text('provider')->nullable()->comment('प्रदायक');
            $table->string('duration')->nullable()->comment('अवधि');
            $table->string('venue')->nullable()->comment('स्थल');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainer_experience_as_trainees');
    }
};
