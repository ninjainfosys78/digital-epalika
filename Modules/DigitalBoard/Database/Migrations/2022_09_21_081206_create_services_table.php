<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('service_name')->comment('सेवा नाम');
            $table->string('time_taken')->nullable()->comment('समय लाग्यो');
            $table->string('responsible_officer')->nullable()->comment('जिम्मेवार अधिकारी');
            $table->string('office')->nullable()->comment('कार्यालय');
            $table->text('remarks')->nullable()->comment('कैफियत');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
