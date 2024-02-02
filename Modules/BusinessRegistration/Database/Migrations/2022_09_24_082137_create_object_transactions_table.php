<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('object_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('शिर्षक');
            $table->foreignId('object_transaction_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('object_transactions');
    }
};
