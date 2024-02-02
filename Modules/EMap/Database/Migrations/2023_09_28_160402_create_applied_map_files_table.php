<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('applied_map_files', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('fileable');
            $table->foreignId('map_apply_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('document');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applied_map_files');
    }
};
