<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attach_documents', function (Blueprint $table) {
            $table->string('land_owner_document_status')->default('pending');
            $table->string('land_revenue_document_status')->default('pending');
            $table->string('land_owner_citizenship_status')->default('pending');
            $table->string('blue_print_status')->default('pending');
            $table->string('pass_document_status')->default('pending');
            $table->string('designer_document_status')->default('pending');
            $table->string('permission_document_status')->default('pending');
            $table->string('inheritance_document_status')->default('pending');
            $table->string('analysis_document_status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attach_documents', function (Blueprint $table) {
            $table->dropColumn(
                'land_owner_document_status',
                'land_revenue_document_status',
                'land_owner_citizenship_status',
                'blue_print_status',
                'pass_document_status',
                'designer_document_status',
                'permission_document_status',
                'inheritance_document_status',
                'analysis_document_status'
            );
        });
    }
};
