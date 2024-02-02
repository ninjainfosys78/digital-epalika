<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('sipharis_signature_details', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('position');
            $table->text('signature')->nullable();
            $table->boolean('status')->default(true)->comment('स्थिति');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sipharis_signature_details');
    }
};
