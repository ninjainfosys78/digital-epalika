<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('sipharis_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sipharis_category_id')->constrained('sipharis_categories')->onDelete('cascade');
            $table->string('title')->comment('शीर्षक');
            ;
            $table->boolean('status')->default(true)->comment('स्थिति');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sipharis_sub_categories');
    }
};
