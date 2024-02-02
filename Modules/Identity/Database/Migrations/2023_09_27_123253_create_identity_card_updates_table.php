<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('identity_card_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disability_identity_card_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('date');
            $table->json('new_data');
            $table->json('old_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('identity_card_updates');
    }
};
