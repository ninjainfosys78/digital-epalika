<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('tax_payers', function (Blueprint $table) {
            $table->string('occupation')->comment('पेशा')->nullable();
            $table->foreignId('province_id')->comment('प्रदेश')->nullable()->constrained()->nullOnDelete()->after('occupation');
            $table->foreignId('district_id')->comment('जिल्ला')->nullable()->constrained()->nullOnDelete()->after('province_id');
            $table->foreignId('local_body_id')->comment('पालिका')->nullable()->constrained()->nullOnDelete()->after('district_id');
            $table->string('village')->comment('गाउँ')->nullable()->after('tole');
            $table->string('house_no')->comment('घर नं.')->nullable()->after('village');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('tax_payers', function (Blueprint $table) {
            $table->dropColumn(['occupation', 'village', 'house_no']);
            $table->dropConstrainedForeignId('province_id');
            $table->dropConstrainedForeignId('district_id');
            $table->dropConstrainedForeignId('local_body_id');
        });
    }
};
