<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('tax_payer_families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_payer_id')->constrained('tax_payers')->cascadeOnDelete();
            $table->string('name')->comment('नाम');
            $table->string('relation')->comment('नाता');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tax_payer_families');
    }
};
