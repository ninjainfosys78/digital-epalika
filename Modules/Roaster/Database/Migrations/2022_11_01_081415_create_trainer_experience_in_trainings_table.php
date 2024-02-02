<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('trainer_experience_in_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained()->cascadeOnDelete();
            $table->string('sector')->nullable()->comment('क्षेत्र');
            $table->string('subject')->nullable()->comment('विषय');
            $table->text('organization')->nullable()->comment('संगठन');
            $table->string('training_level')->nullable()->comment('प्रशिक्षण स्तर');
            $table->string('training_time')->nullable()->comment('प्रशिक्षण समय');
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainer_experience_in_trainings');
    }
};
