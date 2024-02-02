<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('minute_template_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->boolean('status')->default(1);
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('minute_template_settings');
    }
};
