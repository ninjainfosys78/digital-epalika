<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('helplessness_types', function (Blueprint $table) {
            $table->id();
            $table->string('helplessness_type')->comment('असहायताको प्रकार');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('helplessness_types');
    }
};
