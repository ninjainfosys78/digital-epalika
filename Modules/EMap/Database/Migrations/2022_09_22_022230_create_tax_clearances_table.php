<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('tax_clearances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_detail_id')->constrained()->cascadeOnDelete();
            $table->string('document');
            $table->string('year');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tax_clearances');
    }
};
