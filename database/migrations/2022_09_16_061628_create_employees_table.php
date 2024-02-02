<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('नाम');
            $table->string('department')->nullable()->comment('विभाग');
            $table->string('designation')->nullable()->comment('पदनाम');
            $table->string('photo')->nullable()->comment('फोटो');
            $table->string('email')->nullable()->comment('इमेल');
            $table->string('phone')->nullable()->comment('फोटो');
            $table->foreignId('employee_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->integer('position')->nullable()->comment('स्थान');
            $table->boolean('status')->default(true)->comment('स्थिति');
            $table->boolean('is_dept_head')->default(false);
            //new columns
            $table->string('gender');
            $table->string('dob')->nullable();
            $table->string('dob_ad')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('ethnicity_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('pan_no')->nullable();
            $table->string('pis_no')->nullable();
            $table->string('epf_no')->nullable();
            $table->string('cif_no')->nullable();
            $table->string('insurance_card_no')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
