<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('sipharis_created_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sipharish_create_id')->constrained('sipharish_creates')->onDelete('cascade');
            $table->string('title');
            $table->string('filename');
            $table->string('extension')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sipharis_created_documents');
    }
};
