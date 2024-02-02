<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->text('name')->comment('नाम');
            $table->foreignId('fiscal_year_id')->nullable()->comment('आर्थिक वर्ष')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->timestamp('open_date')->nullable()->comment('फारम खुल्ने मिति');
            $table->timestamp('closed_date')->nullable()->comment('फारम बन्द हुने मिति');
            $table->timestamp('closed_at')->nullable();
            $table->text('aim')->nullable()->comment('लक्ष्य');
            $table->text('description')->nullable()->comment('विवरण');
            $table->text('included_subjects')->nullable()->comment('समावेश विषयहरू');
            $table->string('places')->nullable();
            $table->double('pre_max_mark', 10, 2)->nullable();
            $table->double('pre_min_mark', 10, 2)->nullable();
            $table->double('pre_average_mark', 10, 2)->nullable();
            $table->double('post_max_mark', 10, 2)->nullable();
            $table->double('post_min_mark', 10, 2)->nullable();
            $table->double('post_average_mark', 10, 2)->nullable();
            //new columns
            $table->timestamp('trainee_open_date')->nullable()->comment('प्रशिक्षार्थीको लागि खुल्ने मिति');
            $table->timestamp('trainee_closed_date')->nullable()->comment('प्रशिक्षार्थीको बन्द हुने मिति');
            $table->timestamp('organization_open_date')->nullable()->comment('संस्था देखि खुल्ने मिति');
            $table->timestamp('organization_closed_date')->nullable()->comment('संस्था देखि बन्द हुने मिति');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainings');
    }
};
