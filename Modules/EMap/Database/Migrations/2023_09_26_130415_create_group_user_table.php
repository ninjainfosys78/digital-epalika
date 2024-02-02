<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('map_pass_group_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('map_pass_group_id')->constrained()->cascadeOnDelete();
            $table->string('ward_no')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('map_pass_group_user');
    }
};
