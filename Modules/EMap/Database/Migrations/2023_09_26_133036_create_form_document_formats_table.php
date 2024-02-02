<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('form_document_formats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->longText('description');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_document_formats');
    }
};
