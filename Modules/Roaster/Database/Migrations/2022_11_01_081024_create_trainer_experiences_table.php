<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('trainer_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('designation_id')->comment('पद')->constrained()->cascadeOnDelete();
            $table->string('office')->comment('कार्यालय');
            $table->string('responsibility')->nullable()->comment('जिम्मेवारी');
            $table->string('from')->comment('देखि');
            $table->string('to')->nullable()->comment('सम्म');
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainer_experiences');
    }
};
