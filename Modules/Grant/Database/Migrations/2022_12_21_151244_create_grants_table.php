<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('grants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_year_id')->comment('आर्थिक वर्ष')->constrained();
            $table->foreignId('grant_type_id')->comment('अनुदानको प्रकार')->constrained();
            $table->foreignId('grant_office_id')->comment('अनुदान दिने संस्था')->nullable()->constrained();
            $table->text('grant_program_name')->comment('अनुदान कार्यक्रम');
            $table->foreignId('branch_id')->comment('शाखा')->nullable()->constrained();
            $table->double('grant_amount', 12, 2)->comment('अनुदान रकम')->default(0);
            $table->string('grant_for')->comment('कसको लागि अनुदान?');
            $table->text('main_activity')->comment('मुख्य कार्य')->nullable();
            $table->text('remarks')->comment('कैफियत')->nullable();
            $table->foreignId('user_id')->comment('डाटा हाल्ने व्यक्ति')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grants');
    }
};
