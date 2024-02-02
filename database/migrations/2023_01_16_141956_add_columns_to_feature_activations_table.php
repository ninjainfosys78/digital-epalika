<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('feature_activations', function (Blueprint $table) {
            $table->text('feature_description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('feature_activations', function (Blueprint $table) {
            $table->dropColumn('feature_description');
        });
    }
};
