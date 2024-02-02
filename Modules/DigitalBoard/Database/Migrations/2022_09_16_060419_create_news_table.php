<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('शीर्षक');
            $table->string('date')->nullable()->comment('मिति');
            $table->text('description')->nullable()->comment('विवरण');
            $table->dateTime('closed_at')->nullable()->comment('बन्द');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
};
