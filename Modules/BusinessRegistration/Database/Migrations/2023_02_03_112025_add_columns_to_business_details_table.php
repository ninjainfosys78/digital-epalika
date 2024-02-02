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
    public function up()
    {
        Schema::table('business_details', function (Blueprint $table) {
            $table->string('bill_no')->nullable()->comment('बिल नं.');
            $table->string('bill_date_bs')->nullable()->comment('बिल मिति बि स.');
            $table->string('bill_date_ad')->nullable()->comment('बिल मिति ई स.');
            $table->string('other_file')->nullable();
            $table->double('amount', 12, 2)->nullable()->default(0)->comment('रकम');
            $table->string('taxpayer_number')->nullable()->comment('करदाता नम्बर');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_details', function (Blueprint $table) {
            $table->dropColumn('bill_no', 'bill_date_bs', 'bill_date_ad', 'other_file', 'amount', 'taxpayer_number');
        });
    }
};
