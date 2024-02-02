<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('file_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_tracking_id')->constrained()->cascadeOnDelete();
            $table->string('date_bs');
            $table->date('date_ad');
            $table->foreignId('received_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->nullable();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('assigned_branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_activities');
    }
};
