<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('map_applies', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('unique_id')->nullable();
            $table->string('registration_no')->nullable()->comment('दर्ता नम्बर');
            $table->string('registration_date')->nullable()->comment('दर्ता मिति');
            $table->string('construction_type')->comment('निर्माण कार्यको किसिम');
            $table->string('usage')->nullable()->comment('प्रयोजन');
            $table->string('building_category')->nullable()->comment('भवन ऐन अनुसार वर्गीकरण');
            $table->foreignId('structure_type_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('fiscal_year_id')->nullable()->constrained()->cascadeOnDelete();
            $table->double('current_storey', 8, 2)->comment('हाल निर्माण गर्ने तल्ला संख्या');
            $table->double('future_storey', 8, 2)->comment('भविष्यमा निर्माण गर्ने तल्ला संख्या');
            $table->double('area_of_plinth', 12, 2)->nullable()->comment('प्लिन्थको क्षेत्रफल');
            $table->double('length', 12, 2)->nullable()->comment('कुल भवनको लम्बाई');
            $table->double('breadth', 12, 2)->nullable()->comment('कुल भवनको चौडाई');
            $table->double('height', 12, 2)->nullable()->comment('भवनको कुल उचाई जमिनको सतहबाट');
            $table->foreignId('organization_id')->nullable()->constrained()->nullOnDelete();
            $table->string('consultant_signature')->nullable();
            $table->string('consultant_name')->nullable();
            $table->string('consultant_mobile_no')->nullable();
            $table->string('consultant_nec_no')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('map_applies');
    }
};
