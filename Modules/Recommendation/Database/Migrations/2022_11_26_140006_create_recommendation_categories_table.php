<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('recommendation_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->comment('प्रयोगकर्ता')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('title')->comment('शिर्षक');
            $table->foreignId('recommendation_category_id')->nullable()->comment('सिफारिस प्रकार')->constrained()->cascadeOnDelete();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recommendation_categories');
    }
};
