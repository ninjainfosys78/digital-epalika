<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('dispatch_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispatch_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dispatch_details');
    }
};
