<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no')->comment('दर्ता नं.');
            $table->foreignId('fiscal_year_id')->comment('आर्थिक वर्ष')->constrained()->cascadeOnDelete();
            $table->string('project_name')->comment('आयोजनाको नाम');
            $table->foreignId('plan_area_id')->nullable()->comment('योजना क्षेत्र')->constrained()->nullOnDelete();
            $table->string('project_status')->comment('आयोजनाको अवस्था');
            $table->string('project_start_date')->nullable()->comment('आयोजना हुने सुरु मिति');
            $table->string('project_completion_date')->nullable()->comment('आयोजना सम्पन्‍न हुने मिति');
            $table->foreignId('plan_level_id')->nullable()->comment('योजना स्तर')->constrained()->nullOnDelete();
            $table->string('ward_no')->nullable()->comment('वार्ड नं.');
            $table->double('allocated_amount', 12, 2)->default(0)->comment('विनियोजित रकम');
            $table->string('project_venue')->nullable()->comment('कार्यक्रम स्थल');
            $table->double('evaluation_amount', 12, 2)->default(0)->comment('मूल्याङ्कन रकम');
            $table->string('purpose')->nullable()->comment('उद्देश्य');
            $table->string('operated_through')->nullable()->comment('मार्फत सञ्चालन');
            $table->double('progress_spent_amount', 12, 2)->default(0)->comment('वित्तीय प्रगति खर्च रकम');
            $table->double('physical_progress_target', 12, 2)->default(0)->comment('भौतिक प्रगति लक्ष्य परिमाण');
            $table->double('physical_progress_completed', 12, 2)->default(0)->comment('भौतिक प्रगति सम्पन्न परिमाण');
            $table->string('physical_progress_unit')->nullable()->comment('भौतिक प्रगति एकाइ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }

};
