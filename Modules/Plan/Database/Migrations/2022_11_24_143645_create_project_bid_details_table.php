<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up()
    {
        Schema::create('project_bid_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->double('cost_estimation', 12, 2)->default(0)->comment('लागत अनुमान');
            $table->string('notice_published_date')->nullable()->comment('सूचना प्रकाशित मिति');
            $table->string('newspaper_name')->nullable()->comment('पत्रिकाको नाम');
            $table->string('contract_evaluation_decision_date')->nullable()->comment('अनुबंध मूल्याङ्कन निर्णय मिति');
            $table->string('intent_notice_publish_date')->nullable()->comment('आशय सूचना प्रकाशित मिति');
            $table->string('contract_newspaper_name')->nullable()->comment('सम्झौता पत्रपत्रिका नाम');
            $table->string('contract_acceptance_decision_date')->nullable()->comment('सम्झौता स्वीकृति निर्णय मिति');
            $table->double('contract_percentage', 12, 2)->default(0)->comment('सम्झौता प्रतिशत');
            $table->string('contractor_name')->nullable()->comment('ठेकेदार नाम');
            $table->string('contractor_address')->nullable()->comment('ठेकेदार ठेगाना');
            $table->string('contractor_phone')->nullable()->comment('ठेकेदार फोन');
            $table->string('confession_number')->nullable()->comment('कबुली नं');
            $table->string('contract_agreement_date')->nullable()->comment('सम्झौता मिति');
            $table->string('contract_assigned_date')->nullable()->comment('सम्झौता तोकिएको मिति');
            $table->double('bid_bond_amount', 12, 2)->default(0)->comment('बोलपत्र रकम');
            $table->string('bid_bond_no')->nullable()->comment('बोलपत्र नं');
            $table->string('bid_bond_bank_name')->nullable()->comment('बोलपत्र बैंक नाम');
            $table->string('bid_bond_issue_date')->nullable()->comment('बोलपत्र जारी मिति');
            $table->string('bid_bond_expiry_date')->nullable()->comment('बोलपत्रको म्याद सकिने मिति');
            $table->string('performance_bond_no')->nullable()->comment('प्रदर्शन बांड नं');
            $table->double('performance_bond_amount', 12, 2)->nullable()->comment('प्रदर्शन बांड रकम');
            $table->string('performance_bond_bank')->nullable()->comment('प्रदर्शन बांड बैंक');
            $table->string('performance_bond_issue_date')->nullable()->comment('प्रदर्शन बांड जारी मिति');
            $table->string('performance_bond_expiry_date')->nullable()->comment('प्रदर्शन बन्ड समाप्ति मिति');
            $table->string('performance_bond_extended_date')->nullable()->comment('प्रदर्शन बांड विस्तारित मिति');
            $table->string('insurance_issue_date')->nullable()->comment('बीमा जारी मिति');
            $table->string('insurance_expiry_date')->nullable()->comment('बीमा समाप्ति मिति');
            $table->string('insurance_extended_date')->nullable()->comment('बीमा विस्तारित मिति');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_bid_details');
    }
};
