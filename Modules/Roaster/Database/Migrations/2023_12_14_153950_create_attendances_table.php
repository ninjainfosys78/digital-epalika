<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('trainee_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->date('date')->nullable()->comment('मिति');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
