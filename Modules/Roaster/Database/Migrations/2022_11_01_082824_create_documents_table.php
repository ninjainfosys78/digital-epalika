<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->string('title')->nullable()->comment('शीर्षक');
            $table->string('document')->comment('कागजात');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
