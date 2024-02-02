<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('office_headers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('शीर्षक');
            $table->string('font')->nullable()->comment('फन्ट');
            $table->string('font_size')->nullable()->comment('फन्ट साइज');
            $table->string('position')->nullable()->comment('स्थान');
            $table->string('font_color')->nullable()->comment('फन्ट रङ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('office_headers');
    }
};
