<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('sipharis_categories', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('sipharis_categories');
    }
};
