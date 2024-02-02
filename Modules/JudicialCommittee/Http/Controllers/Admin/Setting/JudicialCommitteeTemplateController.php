<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\JudicialCommittee\Entities\JudicialCommitteeTemplate;
use Modules\JudicialCommittee\Http\Requests\Template\StoreJudicialCommitteeTemplateRequest;
use Modules\JudicialCommittee\Http\Requests\Template\UpdateJudicialCommitteeTemplateRequest;

class JudicialCommitteeTemplateController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('judicialCommitteeTemplate_access');

        $judicialCommitteeTemplates = JudicialCommitteeTemplate::all();

        return view('judicialcommittee::admin.setting.template.index', compact('judicialCommitteeTemplates'));
    }

    public function create()
    {
        $this->checkAuthorization('judicialCommitteeTemplate_create');

        return view('judicialcommittee::admin.setting.template.create');
    }

    public function store(StoreJudicialCommitteeTemplateRequest $request)
    {
        $this->checkAuthorization('judicialCommitteeTemplate_create');

        JudicialCommitteeTemplate::create($request->validated());
        Cache::forget('judicialCommitteeTemplates');

        toast('टेम्प्लेट सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(JudicialCommitteeTemplate $judicialCommitteeTemplate)
    {
        $this->checkAuthorization('judicialCommitteeTemplate_access');

        return view('judicialcommittee::show');
    }

    public function edit(JudicialCommitteeTemplate $judicialCommitteeTemplate)
    {
        $this->checkAuthorization('judicialCommitteeTemplate_edit');

        return view('judicialcommittee::admin.setting.template.edit', compact('judicialCommitteeTemplate'));
    }

    public function update(UpdateJudicialCommitteeTemplateRequest $request, JudicialCommitteeTemplate $judicialCommitteeTemplate)
    {
        $this->checkAuthorization('judicialCommitteeTemplate_edit');

        $judicialCommitteeTemplate->update($request->validated());

        Cache::forget('judicialCommitteeTemplates');

        toast('टेम्प्लेट सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.judicialCommittee.setting.judicialCommitteeTemplate.index'));
    }

    public function destroy(JudicialCommitteeTemplate $judicialCommitteeTemplate)
    {
        $this->checkAuthorization('judicialCommitteeTemplate_delete');

        $judicialCommitteeTemplate->delete();
        Cache::forget('judicialCommitteeTemplates');

        toast('टेम्प्लेट सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}
