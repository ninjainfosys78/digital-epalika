<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('project_grant_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->comment('कार्यक्रम आईडी')->constrained()->cascadeOnDelete();
            $table->string('grant_source')->comment('उपलब्ध गराउने स्रोत/निकाय');
            $table->string('asset_name')->comment('सामाग्रीको नाम');
            $table->double('quantity', 12, 2)->default(0)->comment('परिमाण');
            $table->string('asset_unit')->comment('एकाइ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_grant_details');
    }
};
