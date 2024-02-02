<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('important_links', function (Blueprint $table) {
            $table->id();
            $table->string('link_title')->comment('लिङ्क शीर्षक');
            $table->string('link_url')->comment('लिङ्क url');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('important_links');
    }
};
