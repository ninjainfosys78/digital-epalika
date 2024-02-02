<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('apply_map_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_apply_id')->constrained()->cascadeOnDelete();
            $table->string('file')->comment('फाइल ');
            $table->timestamp('rejected_at')->nullable()->comment('अस्वीकार');
            $table->string('file_type')->comment('फाइलको प्रकार ');
            $table->string('remarks')->nullable()->comment('कैफियत ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apply_map_applications');
    }
};
