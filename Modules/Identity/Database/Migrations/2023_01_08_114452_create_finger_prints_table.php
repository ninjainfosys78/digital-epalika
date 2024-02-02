<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('finger_prints', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->longText('iso_temp');
            $table->longText('ansi_temp');
            $table->longText('iso_image');
            $table->enum('finger', ['left','right']);
            $table->longText('finger_image');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('finger_prints');
    }
};
