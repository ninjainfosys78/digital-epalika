<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('sipharish_form_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sipharis_sub_category_id')->constrained('sipharis_sub_categories')->onDelete('cascade');
            $table->string('title');
            $table->text('content')->nullable();
            $table->boolean('need_approval')->default(true);
            $table->boolean('status')->default(true)->comment('स्थिति');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sipharish_form_types');
    }
};
