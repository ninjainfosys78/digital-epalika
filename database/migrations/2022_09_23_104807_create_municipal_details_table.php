<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('municipal_details', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('शीर्षक');
            $table->string('icon')->nullable()->comment('आइकन');
            $table->string('count')->comment('गणना');
            $table->string('bg_color')->nullable()->comment('पृष्ठभूमि रंग');
            $table->integer('position')->comment('स्थान');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('municipal_details');
    }
};
