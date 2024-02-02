<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('complainant_defendants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_application_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->string('name')->comment('नाम');
            $table->integer('age')->nullable()->comment('उमेर');
            $table->string('father_name')->nullable()->comment('बुवाको नाम');
            $table->string('grandfather_name')->nullable()->comment('हजुरबुबाको नाम');
            $table->string('spouse_name')->nullable()->comment('पति/पत्नीको नाम');
            $table->foreignId('province_id')->nullable()->comment('प्रदेश')->constrained()->nullOnDelete();
            $table->foreignId('district_id')->nullable()->comment('जिल्ला')->constrained()->nullOnDelete();
            $table->foreignId('local_body_id')->nullable()->comment('स्थानीय तह')->constrained()->nullOnDelete();
            $table->integer('ward_no')->nullable()->comment('वार्ड नं.');
            $table->string('tole')->nullable()->comment('टोल');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complainant_defendants');
    }
};
