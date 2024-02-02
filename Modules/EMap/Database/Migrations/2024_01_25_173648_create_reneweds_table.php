<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reneweds', function (Blueprint $table) {
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
        Schema::dropIfExists('reneweds');
    }
};
