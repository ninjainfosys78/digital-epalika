<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('sipharish_created_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sipharish_create_id')->constrained('sipharish_creates')->onDelete('cascade');
            $table->foreignId('sipharish_form_field_id')->constrained('sipharis_form_fields')->onDelete('cascade');
            $table->longText('value');
            $table->string('type')->nullable();
            $table->boolean('status')->default(true)->comment('स्थिति');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sipharish_created_values');
    }
};
