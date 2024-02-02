<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('disability_identity_card_identity_meeting', function (Blueprint $table) {

            Schema::withoutForeignKeyConstraints(function () use ($table) {
                $table->bigInteger('disability_identity_card_id')->unsigned();
                $table->bigInteger('identity_meeting_id')->unsigned();

                $table->foreign('disability_identity_card_id', 'fk_disability_meeting_card_id')->references('id')->on('disability_identity_cards')->onDelete('cascade');
                $table->foreign('identity_meeting_id', 'fk_identity_meeting_id')->references('id')->on('identity_meetings')->onDelete('cascade');

            });

        });
    }

    public function down()
    {
        Schema::dropIfExists('disability_identity_card_identity_meeting');
    }
};
