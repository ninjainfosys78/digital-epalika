<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('attach_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_apply_id')->constrained()->cascadeOnDelete();
            $table->string('land_owner_document');
            $table->string('land_revenue_document');
            $table->string('land_owner_citizenship');
            $table->string('blue_print');
            $table->string('pass_document');
            $table->string('designer_document');
            $table->string('permission_document');
            $table->string('inheritance_document');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attach_documents');
    }
};
