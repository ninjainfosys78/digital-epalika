<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('committees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_type_id')->nullable()->constrained()->nullOnDelete();
            $table->string('committee_name');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('committees');
    }
};
