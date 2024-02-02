<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('pop_up_notices', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('शीर्षक');
            $table->string('date')->comment('मिति');
            $table->longText('description')->nullable()->comment('विवरण');
            $table->dateTime('closed_at')->nullable()->comment('मा बन्द भयो');
            $table->boolean('show_on_index')->default(1)->comment('अनुक्रमणिका मा देखाउनुहोस्');
            $table->foreignId('user_id')->constrained();
            $table->string('ward')->nullable();
            $table->foreignId('fiscal_year_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pop_up_notices');
    }
};
