<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('cash_grants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('नाम');
            $table->string('address')->comment('ठेगान(वडा)');
            $table->string('age')->comment('उमेर');
            $table->string('contact')->comment('सम्पर्क नं');
            $table->string('citizenship_no')->comment('नागरिकत नं');
            $table->string('father_name')->comment(' बुवाको नाम');
            $table->string('grandfather_name')->comment('बाजेको नाम');
            $table->foreignId('helplessness_type_id')->comment('असहायताको प्रकार')->constrained();
            $table->string('cash')->comment('नगद');
            $table->string('file')->comment('कागजपत्र')->nullable();
            $table->text('remark')->comment('कैफियत')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_grants');
    }
};
