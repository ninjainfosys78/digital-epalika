<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('model');
            $table->string('file_name')->nullable();
            $table->string('extension')->nullable();
            $table->string('file');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
};
