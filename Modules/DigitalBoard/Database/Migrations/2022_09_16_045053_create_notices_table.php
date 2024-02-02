<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('शीर्षक');
            $table->string('date')->comment('मिति');
            $table->date('en_date')->nullable()->comment('अंग्रेजी मिति');
            $table->longText('description')->nullable()->comment('विवरण');
            $table->dateTime('closed_at')->nullable()->comment('मा बन्द भयो');
            $table->boolean('show_on_index')->default(1)->comment('अनुक्रमणिका मा देखाउनुहोस्');
            $table->foreignId('user_id')->constrained();
            $table->string('type')->default('Notice')->comment('प्रकार');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notices');
    }
};
