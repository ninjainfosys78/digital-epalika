<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('grant_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grant_id')->comment('अनुदान')->constrained()->cascadeOnDelete();
            $table->string('grant_for');
            $table->nullableMorphs('model');
            $table->double('personal_investment', 12, 2)->comment('व्यक्तिगत लगानी')->default(0);
            $table->boolean('is_old')->comment('पुरानो हो?')->default(0);
            $table->foreignId('prev_fiscal_year_id')->comment('पुरानो आर्थिक वर्ष')->nullable()->constrained('fiscal_years')->nullOnDelete();
            $table->double('investment_amount', 12, 2)->comment('लागनी रकम')->default(0);
            $table->text('remarks')->comment('कैफियत')->nullable();
            $table->foreignId('local_body_id')->comment('अनुदान आयोजना भएको पालिका')->nullable()->constrained()->nullOnDelete();
            $table->integer('ward_no')->comment('अनुदान आयोजना भएको वार्ड')->nullable();
            $table->string('village')->comment('अनुदान आयोजना भएको गाउ')->nullable();
            $table->string('tole')->comment('अनुदान आयोजना भएको टोल')->nullable();
            $table->string('plot_no')->comment('कित्ता नं')->nullable();
            $table->string('contact_person')->comment('सम्पर्क व्यक्ति')->nullable();
            $table->string('contact')->comment('सम्पर्क')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grant_details');
    }
};
