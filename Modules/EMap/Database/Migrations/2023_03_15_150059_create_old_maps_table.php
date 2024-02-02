<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('old_maps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_year_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->double('registration_fee', 12, '2')->default(0);
            $table->string('application_type');
            $table->string('registration_no')->nullable()->comment('दर्ता नम्बर');
            $table->string('registration_date')->nullable()->comment('दर्ता मिति');
            $table->string('construction_type')->comment('निर्माण कार्यको किसिम');
            $table->string('usage')->comment('प्रयोजन');
            $table->string('building_category')->comment('भवन ऐन अनुसार वर्गीकरण');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('old_maps');
    }
};
