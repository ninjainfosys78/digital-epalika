<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('trainer_qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained()->cascadeOnDelete();
            $table->string('achievement')->comment('उपलब्धि');
            $table->text('institute')->comment('संस्थान');
            $table->string('passed_year')->nullable();
            $table->text('major_subjects')->nullable()->comment('प्रमुख विषयहरू');
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainer_qualifications');
    }
};
