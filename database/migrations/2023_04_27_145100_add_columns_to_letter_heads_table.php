<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('letter_heads', function (Blueprint $table) {
            $table->longText('header_en')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('letter_heads', function (Blueprint $table) {
            $table->dropColumn('header_en');
        });
    }
};
