<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('identity_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disability_identity_card_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('print_date');
            $table->string('print_date_en');
            $table->string('old_print_date')->nullable();
            $table->string('old_print_date_en')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('identity_records');
    }
};
