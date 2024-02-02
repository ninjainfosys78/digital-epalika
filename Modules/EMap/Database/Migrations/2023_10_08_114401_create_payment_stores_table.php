<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('payment_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->cascadeOnDelete();
            $table->foreignId('map_apply_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->string('bill');
            $table->float('amount')->default(0);
            $table->nullableMorphs('form_data');
            $table->nullableMorphs('uploaded_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_stores');
    }
};
