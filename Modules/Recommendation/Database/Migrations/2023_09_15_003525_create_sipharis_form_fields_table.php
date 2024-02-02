<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('sipharis_form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sipharish_form_type_id')->nullable()->constrained('sipharish_form_types')->onDelete('cascade');
            $table->string('field_name');
            $table->string('slug')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sipharis_form_fields');
    }
};
