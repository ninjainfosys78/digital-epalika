<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('judicial_committee_templates', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('प्रकार');
            $table->string('title')->comment('शीर्षक');
            $table->longText('data')->comment('डाटा');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('judicial_committee_templates');
    }
};
