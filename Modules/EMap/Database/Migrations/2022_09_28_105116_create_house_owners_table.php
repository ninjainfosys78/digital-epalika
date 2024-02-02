<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('house_owners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_apply_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name')->nullable()->comment('नाम');
            $table->string('phone')->nullable()->comment('फोन नं.');
            $table->string('father_name')->nullable()->comment('बुवाको नाम');
            $table->string('grandfather_name')->nullable()->comment('हजुरबुबाको नाम');
            $table->string('citizenship_issue_district_id')->nullable()->comment('नागरिकता लिएको जिल्ला');
            $table->string('citizenship_no')->nullable()->comment('नागरिकत नम्बर');
            $table->string('citizenship_issue_date')->nullable()->comment('नागरिकता लिएको मिति');
            $table->text('address')->nullable()->comment('ठेगाना');
            $table->string('local_body')->nullable()->comment('पालिका');
            $table->integer('ward_no')->nullable()->comment('वडा नं');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('house_owners');
    }
};
