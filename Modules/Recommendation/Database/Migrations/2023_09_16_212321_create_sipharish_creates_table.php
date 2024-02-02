<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('sipharish_creates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sipharis_form_type_id')->constrained('sipharish_form_types')->onDelete('cascade');
            $table->foreignId('signatured_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->date('approved_date')->nullable();
            $table->enum('approved_status', ['approved','rejected','pending'])->default('pending');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->boolean('status')->default(true)->comment('स्थिति');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sipharish_creates');
    }
};
