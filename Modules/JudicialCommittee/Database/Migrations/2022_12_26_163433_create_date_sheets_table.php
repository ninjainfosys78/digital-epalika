<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('date_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_application_id')->constrained()->cascadeOnDelete();
            $table->string('year')->comment('आवेदन वर्ष');
            $table->string('case_name')->nullable()->comment('केस नाम');
            $table->string('appearance_date')->comment('हाजिर हुने मिति');
            $table->time('appearance_time')->comment('हाजिर हुने समय');
            $table->string('submitted_date')->nullable()->comment('पेश मिति');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('date_sheets');
    }
};
