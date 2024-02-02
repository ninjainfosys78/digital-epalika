<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('tax_payers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_payer_type_id')->comment('करदाताको प्रकार')->constrained('tax_payer_types');
            $table->foreignId('fiscal_year_id')->comment('आर्थिक वर्ष')->constrained('fiscal_years');
            $table->foreignId('user_id')->comment('दाखिला गर्ने व्यक्ति')->constrained('users');
            $table->string('registration_no')->comment('दर्ता नं.');
            $table->string('name')->comment('नाम');
            $table->string('name_en')->comment('नाम (अंग्रेजीमा)');
            $table->string('phone')->comment('फोन');
            $table->string('email')->comment('इमेल')->nullable();
            $table->string('address')->comment('ठेगाना')->nullable();
            $table->string('gender')->comment('लिङ्ग')->nullable();
            $table->string('father_name')->comment('बुवाको नाम')->nullable();
            $table->string('grandfather_name')->comment('हजुरबुवाको नाम')->nullable();
            $table->string('citizenship_no')->comment('नागरिकता नं');
            $table->string('issued_district')->comment('जारी जिल्ल्ला');
            $table->string('issued_date')->comment('जारि मिति');
            $table->string('ward')->comment('वडा');
            $table->string('tole')->comment('टोल');
            $table->text('remarks')->comment('कैफियत')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tax_payers');
    }
};
