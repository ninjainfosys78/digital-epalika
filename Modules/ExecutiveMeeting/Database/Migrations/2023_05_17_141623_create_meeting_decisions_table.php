<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('meeting_decisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_id')->constrained()->cascadeOnDelete();
            $table->string('date')->nullable()->comment('मिति (वि.स.)');
            $table->string('chairman')->nullable()->comment('अध्यक्ष');
            $table->string('en_date')->nullable()->comment('मिति (ई.स.)');
            $table->longText('description')->nullable()->comment('विवरण');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meeting_decisions');
    }
};
