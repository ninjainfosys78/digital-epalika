<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('project_deadline_extensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('extended_date')->comment('म्याद थप मिति');
            $table->string('en_extended_date')->nullable()->comment('म्याद थप मिति ई.सं.');
            $table->string('submitted_date')->comment('पेश मिति');
            $table->string('en_submitted_date')->nullable()->comment('पेश मिति ई.सं.');
            $table->text('remarks')->nullable()->comment('कैफियत');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_deadline_extensions');
    }
};
