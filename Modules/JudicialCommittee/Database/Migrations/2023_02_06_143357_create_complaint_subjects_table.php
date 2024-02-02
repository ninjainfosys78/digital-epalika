<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('complaint_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawsuit_nature_id')->constrained()->cascadeOnDelete();
            $table->string('subject');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complaint_subjects');
    }
};
