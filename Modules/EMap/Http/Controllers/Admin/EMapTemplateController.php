<?php

namespace Modules\EMap\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\EMap\Entities\EMapTemplate;
use Modules\EMap\Http\Requests\Template\StoreEMapTemplateRequest;
use Modules\EMap\Http\Requests\Template\UpdateEMapTemplateRequest;
use View;

class EMapTemplateController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('eMapTemplate_access');

        $eMapTemplates = EMapTemplate::latest()->get();

        return view('emap::admin.template.index', compact('eMapTemplates'));
    }

    public function create()
    {
        $this->checkAuthorization('eMapTemplate_create');

        return view('emap::admin.template.create');
    }

    public function store(StoreEMapTemplateRequest $request): RedirectResponse
    {
        $this->checkAuthorization('eMapTemplate_create');
        $this->forgotCache('eMapTemplates');
        EMapTemplate::create($request->validated());

        toast('टेम्प्लेट सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(EMapTemplate $eMapTemplate)
    {
        $this->checkAuthorization('eMapTemplate_access');

        return view('emap::show');
    }

    public function edit(EMapTemplate $eMapTemplate)
    {
        $this->checkAuthorization('eMapTemplate_edit');

        return view('emap::admin.template.edit', compact('eMapTemplate'));
    }

    public function update(UpdateEMapTemplateRequest $request, EMapTemplate $eMapTemplate)
    {
        $this->checkAuthorization('eMapTemplate_edit');

        $this->forgotCache('eMapTemplates');
        $eMapTemplate->update($request->validated());

        toast('टेम्प्लेट सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('emap.admin.eMapTemplate.index'));
    }

    public function destroy(EMapTemplate $eMapTemplate): RedirectResponse
    {
        $this->checkAuthorization('eMapTemplate_delete');
        if ($eMapTemplate->status == 1) {
            toast('Error while deleting file', 'error');

            return back();
        }
        $this->forgotCache('eMapTemplates');
        $eMapTemplate->delete();
        toast('टेम्प्लेट सफलतापूर्वक मेटियो', 'success');
        return back();
    }

    public function getStaticTemplate(Request $request)
    {
        $this->checkAuthorization('eMapTemplate_create');

        $request->validate([
            'type' => ['required'],
        ]);

        return match ($request->input('type')) {
            'naksa_certificate' => View::make('emap::admin.notice.naksa_certificate'),
            'level' => View::make('emap::admin.notice.level'),
            'superstructure' => View::make('emap::admin.notice.superstructure'),
            'construction-completion-certificate' => View::make('emap::admin.notice.building_construction_completion_certificate'),
            default => 'Enter Valid Type',
        };
    }

    public function updateStatus(EMapTemplate $eMapTemplate): RedirectResponse
    {
        $this->checkAuthorization('eMapTemplate_access');

        DB::transaction(function () use ($eMapTemplate) {
            $this->forgotCache('eMapTemplates');
            $eMapTemplate->update([
                'status' => 1
            ]);
        });

        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    public function enumList()
    {
        return view('emap::admin.template.enumList');
    }
}
