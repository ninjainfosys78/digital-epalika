<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('four_forts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_apply_id')->constrained()->cascadeOnDelete();
            $table->string('detail')->comment('विवरण');
            $table->string('east')->comment('पूर्व');
            $table->string('south')->comment('दक्षिण');
            $table->string('west')->comment('पश्चिम');
            $table->string('north')->comment('उत्तर');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('four_forts');
    }
};
