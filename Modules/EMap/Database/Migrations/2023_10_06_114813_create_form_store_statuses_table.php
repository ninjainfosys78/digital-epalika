<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('form_store_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_store_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->text('comment')->nullable();
            $table->json('data');
            $table->json('fields')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_store_statuses');
    }
};
