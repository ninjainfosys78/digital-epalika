<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('project_installment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->comment('कार्यक्रम आईडी')->constrained()->cascadeOnDelete();
            $table->string('installment_type')->comment('किस्ता प्रकार');
            $table->string('date')->nullable()->comment('मिति');
            $table->double('amount', 12, 2)->default(0)->comment('रकम');
            $table->string('construction_material_quantity')->nullable()->comment('निर्माण मिटरियल मात्रा');
            $table->text('remarks')->nullable()->comment('कैफियत');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_installment_details');
    }
};
