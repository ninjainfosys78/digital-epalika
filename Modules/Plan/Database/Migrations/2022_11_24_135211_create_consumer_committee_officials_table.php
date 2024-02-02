<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('consumer_committee_officials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consumer_committee_id')->comment('उपभोक्ता समिति आईडी')->constrained()->cascadeOnDelete();
            $table->string('post')->comment('पोस्ट');
            $table->string('name')->comment('नाम');
            $table->string('father_name')->nullable()->comment('बुबाको नाम');
            $table->string('grandfather_name')->nullable()->comment('हजुरबुबाको नाम');
            $table->string('address')->nullable()->comment('ठेगाना');
            $table->string('gender')->nullable()->comment('लिङ्ग');
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('citizenship_no')->nullable()->comment('नागरिकता नं');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consumer_committee_officials');
    }
};
