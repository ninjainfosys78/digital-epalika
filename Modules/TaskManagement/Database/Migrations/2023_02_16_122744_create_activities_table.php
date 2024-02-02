<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable()->comment('मिति बि.सं.');
            $table->string('date_en')->nullable()->comment('मिति ई.सं.');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete()->comment('शाखा');
            $table->foreignId('fiscal_year_id')->nullable()->constrained('fiscal_years')->nullOnDelete()->comment('शाखा');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->comment('कार्य गरेको व्यक्ति');
            $table->text('remarks')->nullable()->comment('कैफियत');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
    }
};
