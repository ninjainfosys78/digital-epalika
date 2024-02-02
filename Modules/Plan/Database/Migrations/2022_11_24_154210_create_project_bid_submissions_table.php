<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('project_bid_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->comment('कार्यक्रम आईडी')->constrained()->cascadeOnDelete();
            $table->string('submission_type')->comment('बुझाउने प्रकार');
            $table->string('submission_no')->comment('बुझाउने नम्बर');
            $table->string('date')->comment('मिति');
            $table->double('amount', 12, 2)->default(0)->comment('रकम');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_bid_submissions');
    }
};
