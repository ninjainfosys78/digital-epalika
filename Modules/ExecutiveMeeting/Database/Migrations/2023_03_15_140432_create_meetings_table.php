<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_id')->comment('समिति')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('meeting_id')->nullable()->constrained()->nullOnDelete();
            $table->string('meeting_name')->comment('बैठक नाम');
            $table->string('recurrence')->comment('पुनरावृत्ति')->nullable();
            $table->string('start_date')->comment('सुरू मिति (वि. स.)');
            $table->date('en_start_date')->comment('सुरू मिति (ई. स.)');
            $table->string('end_date')->comment('अन्तिम मिति (वि. स.)')->nullable();
            $table->date('en_end_date')->comment('अन्तिम मिति (ई. स.)')->nullable();
            $table->string('recurrence_end_date')->comment('पुनरावृत्ति मिति (वि.स.)')->nullable();
            $table->date('en_recurrence_end_date')->comment('पुनरावृत्ति मिति (ई. स.)')->nullable();
            $table->text('description')->comment('विवरण')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_print')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meetings');
    }
};
