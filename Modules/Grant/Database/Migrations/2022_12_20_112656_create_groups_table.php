<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->comment('समूह आइडी')->unique();
            $table->string('name')->comment('नाम');
            $table->string('registration_date')->comment('दर्ता मिति');
            $table->string('registered_office')->comment('दर्ता भएको कार्यालय');
            $table->string('monthly_meeting')->comment('माषिक बैठक')->nullable();
            $table->string('vat_pan')->comment('भ्याट प्यान')->nullable();
            $table->foreignId('province_id')->comment('प्रदेश')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('district_id')->comment('जिल्ला')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('local_body_id')->comment('पालिका')->nullable()->constrained()->nullOnDelete();
            $table->integer('ward_no')->comment('वार्ड')->nullable();
            $table->string('village')->comment('गाउ')->nullable();
            $table->string('tole')->comment('टोल')->nullable();
            $table->foreignId('user_id')->comment('डाटा हाल्ने व्यक्ति')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
};
