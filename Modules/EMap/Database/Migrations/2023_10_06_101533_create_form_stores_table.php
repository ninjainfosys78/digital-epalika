<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('form_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->cascadeOnDelete();
            $table->foreignId('map_apply_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->json('data');
            $table->json('fields')->nullable();
            $table->nullableMorphs('uploaded_by');
            $table->nullableMorphs('form_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_stores');
    }
};
