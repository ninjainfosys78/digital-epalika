<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('benefited_member_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->comment('कार्यक्रम आईडी')->constrained()->cascadeOnDelete();
            $table->integer('ward_no')->comment('वार्ड नं.');
            $table->string('village')->comment('गाउँ');
            $table->integer('dalit_backward_no')->nullable()->comment('दलित पिछडिएको घरधुरी संख्या');
            $table->integer('other_households_no')->nullable()->comment('अन्य घरधुरी संख्या');
            $table->integer('no_of_male')->nullable()->comment('पुरुष संख्या');
            $table->integer('no_of_female')->nullable()->comment('महिला संख्या');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('benefited_member_details');
    }
};
