<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('disability_identity_cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->string('citizenship_no')->nullable();
            $table->string('birth_registration_no')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('identity_no')->nullable();
            $table->string('father_name');
            $table->string('father_name_en');
            $table->string('mother_name');
            $table->string('mother_name_en');
            $table->string('dob');
            $table->date('dob_ad');
            $table->string('gender');
            $table->string('blood_group')->nullable();
            $table->integer('number')->default(0);
            $table->string('card_no')->nullable();
            $table->integer('print_count')->default(0);
            $table->foreignId('fiscal_year_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('province_id')->nullable()->constrained('provinces')->nullOnDelete()->onUpdate('no action');
            $table->foreignId('district_id')->nullable()->constrained('districts')->nullOnDelete()->onUpdate('no action');
            $table->foreignId('local_body_id')->nullable()->constrained('local_bodies')->nullOnDelete()->onUpdate('no action');
            $table->integer('ward_no');
            $table->string('tole');
            $table->string('photo')->nullable();
            $table->string('guardian_name');
            $table->string('guardian_name_en');
            $table->foreignId('relationship_id')->nullable()->constrained('relationships')->nullOnDelete()->onUpdate('no action');
            $table->string('phone')->nullable();
            $table->foreignId('disability_type_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('hospital_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('employee_signature_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('gov_disability_type_id')->nullable()->constrained('governmental_disability_types')->nullOnDelete()->onUpdate('no action');
            $table->string('status');
            $table->boolean('is_full_detail_required')->default(0);
            $table->string("disability_reason_id")->nullable();
            $table->string("citizenship_no_place")->nullable();
            $table->string("citizenship_date_ad")->nullable();
            $table->string("citizenship_date")->nullable();
            $table->string("document_photo")->nullable();
            $table->string("document_photo_back")->nullable();
            $table->string("material_description")->nullable();
            $table->string("qualification")->nullable();
            $table->boolean("daily_activity")->default(false);
            $table->boolean("supporting_material")->default(false);
            $table->longText("helping_task")->nullable();
            $table->longText("without_helping_task")->nullable();
            $table->string("main_training_name")->nullable();
            $table->string("occupation_id")->nullable();
            $table->timestamp('recommend_at')->nullable();
            $table->timestamp('first_print_at')->nullable();
            $table->timestamp('latest_print_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disability_identity_cards');
    }
};
