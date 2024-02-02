<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->id();
            $table->text('api_used')->nullable();
            $table->text('phone');
            $table->text('message');
            $table->json("response_data")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms');
    }
};
