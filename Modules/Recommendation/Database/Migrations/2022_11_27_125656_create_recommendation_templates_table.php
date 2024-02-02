<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('recommendation_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('recommendation_category_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('title')->comment('शीर्षक');
            $table->longText('data')->comment('डाटा');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recommendation_templates');
    }
};
