<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('disability_committee_identity_meeting', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_id')->constrained('disability_committees')->cascadeOnDelete();
            $table->foreignId('meeting_id')->constrained('identity_meetings')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('disability_committee_identity_meeting');
    }
};
