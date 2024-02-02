<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('land_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_apply_id')->constrained()->cascadeOnDelete();
            $table->foreignId('land_use_area_id')->nullable()->comment('भूमि प्रयोग क्षेत्र')->constrained()->cascadeOnDelete();
            $table->integer('ward_no')->nullable()->comment('वार्ड नं ');
            $table->integer('former_ward_no')->nullable()->comment('पुर्ब वार्ड नं ');
            $table->string('tole')->nullable()->comment('टोल');
            $table->string('street_code_no')->nullable()->comment('सडक कोड न');
            $table->string('plot_no')->nullable()->comment('प्लट नं');
            $table->double('percentage_of_area_covered_by_building', 10, 2)->default(0)->comment('भवनले ढाकिएको क्षेत्रफलको प्रतिशत');
            $table->foreignId('unit_id')->nullable()->constrained()->nullOnDelete();
            $table->string('unit_value')->default(0)->comment('एकाइ मूल्य');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('land_details');
    }
};
