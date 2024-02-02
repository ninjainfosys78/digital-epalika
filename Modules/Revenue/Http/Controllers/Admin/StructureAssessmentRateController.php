<?php

namespace Modules\Revenue\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Revenue\Entities\StructureAssessmentRate;

class StructureAssessmentRateController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('structureAssessmentRate_access');
        $structureAssessmentRates = StructureAssessmentRate::latest()->get();
        return view('revenue::admin.setting.structure-assessment-rate.index', compact('structureAssessmentRates'));
    }

    public function create()
    {
        $this->checkAuthorization('structureAssessmentRate_create');
        return view('revenue::admin.setting.structure-assessment-rate.create');
    }



    public function edit(StructureAssessmentRate $structureAssessmentRate)
    {
        $this->checkAuthorization('structureAssessmentRate_edit');
        return view('revenue::admin.setting.structure-assessment-rate.edit', compact('structureAssessmentRate'));
    }


    public function destroy(StructureAssessmentRate $structureAssessmentRate)
    {
        $this->checkAuthorization('structureAssessmentRate_delete');

        $structureAssessmentRate->delete();

        toast('स्ट्रकचर सफलतापुर्वक हटाइयो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.physicalStructureType.index');
    }
}
