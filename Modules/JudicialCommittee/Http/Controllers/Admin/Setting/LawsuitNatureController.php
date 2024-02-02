<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Modules\JudicialCommittee\Entities\LawsuitNature;
use Modules\JudicialCommittee\Http\Requests\LawSuiteNature\StoreLawSuiteNatureRequest;
use Modules\JudicialCommittee\Http\Requests\LawSuiteNature\updateLawSuiteNatureRequest;

class LawsuitNatureController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('lawsuitNature_access');

        $lawSuitNatures = LawsuitNature::latest()->get();

        return view('judicialcommittee::admin.setting.lawsuit_nature.index', compact('lawSuitNatures'));
    }

    public function create()
    {
        $this->checkAuthorization('lawsuitNature_create');

        return view('judicialcommittee::admin.setting.lawsuit_nature.create');
    }

    public function store(StoreLawSuiteNatureRequest $request)
    {
        $this->checkAuthorization('lawsuitNature_create');

        LawsuitNature::create($request->validated());

        toast('मुद्दा प्रकृति सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(LawsuitNature $lawsuitNature)
    {
        $this->checkAuthorization('lawsuitNature_edit');

        return view('judicialcommittee::admin.setting.lawsuit_nature.edit', compact('lawsuitNature'));
    }

    public function update(updateLawSuiteNatureRequest $request, LawsuitNature $lawsuitNature)
    {
        $this->checkAuthorization('lawsuitNature_edit');

        $lawsuitNature->update($request->validated());

        toast('मुद्दा प्रकृति सफलतापूर्वक अपडेट गरियो', 'success');
        return redirect(route('admin.judicialCommittee.setting.lawsuitNature.index'));
    }

    public function destroy(LawsuitNature $lawsuitNature)
    {
        $this->checkAuthorization('lawsuitNature_delete');

        $lawsuitNature->delete();

        toast('मुद्दा प्रकृति सफलतापूर्वक हटाइयो', 'success');
        return back();
    }
}
