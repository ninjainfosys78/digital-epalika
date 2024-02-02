<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('नाम');
            $table->foreignId('designation_id')->nullable()->comment('पद')->constrained()->nullOnDelete();
            $table->foreignId('department_id')->nullable()->comment('सेवा समुह')->constrained()->nullOnDelete();
            $table->string('level')->nullable()->comment('तह');
            $table->foreignId('province_id')->nullable()->comment('प्रदेश')->constrained()->nullOnDelete();
            $table->foreignId('district_id')->nullable()->comment('जिल्ला')->constrained()->nullOnDelete();
            $table->foreignId('local_body_id')->nullable()->comment('पालिका')->constrained()->nullOnDelete();
            $table->integer('ward')->nullable()->comment('वार्ड');
            $table->string('tole')->nullable()->comment('टोल');
            $table->string('office')->nullable()->comment('कार्यालय');
            $table->string('appointment_date')->nullable()->comment('नियुक्ति मिति');
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('email')->nullable()->comment('ईमेल');
            $table->string('photo')->nullable();
            $table->string('pan')->nullable()->comment('पान नं.');
            $table->timestamp('approved_at')->nullable();
            $table->string('experience')->nullable()->comment('अनुभव');
            $table->string('qualification')->nullable()->comment('योग्यता');
            $table->string('bank_detail')->nullable()->comment('बैंक विवरण');
            $table->string('experience_as_trainee')->nullable()->comment('प्रशिक्षार्थी अनुभव');
            $table->string('experience_as_trainer')->nullable()->comment('ट्रेनर अनुभव');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainers');
    }
};
