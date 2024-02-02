<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::table('complaint_applications', function (Blueprint $table) {
            $table->foreignId('complaint_subject_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint_applications', function (Blueprint $table) {
            $table->dropConstrainedForeignId('complaint_subject_id');
        });
    }
};
