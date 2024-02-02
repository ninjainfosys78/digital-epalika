<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('service_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('employee_name')->nullable()->comment('कर्मचारी नाम');
            $table->string('photo')->nullable()->comment('फोटो');
            $table->string('email')->nullable()->comment('इमेल');
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('designation')->nullable()->comment('पदनाम');
            $table->integer('position')->default(0)->comment('स्थान');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_employees');
    }
};
