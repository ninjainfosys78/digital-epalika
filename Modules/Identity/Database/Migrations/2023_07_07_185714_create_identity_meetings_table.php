<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('identity_meetings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('date_bs');
            $table->date('date_ad');
            $table->text('description')->nullable();
            $table->longText('minute')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('identity_meetings');
    }
};
