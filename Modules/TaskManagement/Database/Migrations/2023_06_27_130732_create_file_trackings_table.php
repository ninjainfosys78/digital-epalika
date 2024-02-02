<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('file_trackings', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no');
            $table->boolean('is_hardcopy')->default(false);
            $table->text('remarks')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_trackings');
    }
};
