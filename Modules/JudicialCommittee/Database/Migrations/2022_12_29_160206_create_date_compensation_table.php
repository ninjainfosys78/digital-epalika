<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('date_compensation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_application_id')->constrained()->cascadeOnDelete();
            $table->string('decision_date')->comment('निर्णय हुने मिति');
            $table->string('decision_subject')->comment('निर्णय हुने विषय');
            $table->time('decision_time')->comment('निर्णय हुने समय');
            $table->string('submitted_date')->comment('पेश मिति');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('date_compensation');
    }
};
