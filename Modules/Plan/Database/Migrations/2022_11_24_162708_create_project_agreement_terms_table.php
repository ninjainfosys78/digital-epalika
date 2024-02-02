<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('project_agreement_terms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->comment('कार्यक्रम आईडी')->constrained()->cascadeOnDelete();
            $table->longText('data')->comment('डाटा');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_agreement_terms');
    }
};
