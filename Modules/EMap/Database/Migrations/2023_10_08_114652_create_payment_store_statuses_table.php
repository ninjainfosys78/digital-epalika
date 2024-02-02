<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('payment_store_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_store_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->text('comment')->nullable();
            $table->string('bill');
            $table->float('amount')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_store_statuses');
    }
};
