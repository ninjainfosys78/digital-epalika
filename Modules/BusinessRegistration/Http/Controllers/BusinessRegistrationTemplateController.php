<?php

namespace Modules\BusinessRegistration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\BusinessRegistration\Entities\BusinessRegistrationTemplate;
use Modules\BusinessRegistration\Enums\TemplateTypeEnum;
use Modules\BusinessRegistration\Http\Requests\BusinessRegistrationTemplate\StoreBusinessRegistrationTemplateRequest;
use Modules\BusinessRegistration\Http\Requests\BusinessRegistrationTemplate\UpdateBusinessRegistrationTemplateRequest;

class BusinessRegistrationTemplateController extends Controller
{
    public function index(TemplateTypeEnum $templateTypeEnum)
    {
        $this->checkAuthorization('businessRegistrationTemplate_access');
        $businessRegistrationTemplates = BusinessRegistrationTemplate::where('for', $templateTypeEnum->value)->get();

        return view('businessregistration::admin.setting.template.index', compact('businessRegistrationTemplates', 'templateTypeEnum'));
    }

    public function create(TemplateTypeEnum $templateTypeEnum)
    {
        $this->checkAuthorization('businessRegistrationTemplate_create');

        return view('businessregistration::admin.setting.template.create', compact('templateTypeEnum'));
    }

    public function store(StoreBusinessRegistrationTemplateRequest $request, TemplateTypeEnum $templateTypeEnum)
    {
        $this->checkAuthorization('businessRegistrationTemplate_create');

        BusinessRegistrationTemplate::create($request->validated() + [
                'for' => $templateTypeEnum->value,
                'status' => BusinessRegistrationTemplate::where('for', $templateTypeEnum->value)
                    ->where('status', 1)
                    ->count() === 0 ? '1' : '0'
            ]);

        $this->forgotCache('businessTemplates');

        toast('टेम्प्लेट सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(TemplateTypeEnum $templateTypeEnum, BusinessRegistrationTemplate $businessRegistrationTemplate)
    {
        $this->checkAuthorization('businessRegistrationTemplate_access');

        return view('businessregistration::show');
    }

    public function edit(TemplateTypeEnum $templateTypeEnum, BusinessRegistrationTemplate $businessRegistrationTemplate)
    {
        $this->checkAuthorization('businessRegistrationTemplate_edit');

        return view('businessregistration::admin.setting.template.edit', compact('businessRegistrationTemplate', 'templateTypeEnum'));
    }

    public function update(UpdateBusinessRegistrationTemplateRequest $request, TemplateTypeEnum $templateTypeEnum, BusinessRegistrationTemplate $businessRegistrationTemplate)
    {
        $this->checkAuthorization('businessRegistrationTemplate_edit');
        $businessRegistrationTemplate->update($request->validated());

        $this->forgotCache('businessTemplates');

        toast('टेम्प्लेट सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.businessRegistration.setting.businessRegistrationTemplate.index', $templateTypeEnum));
    }

    public function destroy(TemplateTypeEnum $templateTypeEnum, BusinessRegistrationTemplate $businessRegistrationTemplate)
    {
        $this->checkAuthorization('businessRegistrationTemplate_delete');
        if ($businessRegistrationTemplate->status == 1) {
            toast('Error while deleting file', 'error');

            return back();
        }

        $this->forgotCache('businessTemplates');

        $businessRegistrationTemplate->delete();
        toast('टेम्प्लेट सफलतापूर्वक मेटियो', 'success');
        return back();
    }

    public function updateStatus(TemplateTypeEnum $templateTypeEnum, BusinessRegistrationTemplate $businessRegistrationTemplate): RedirectResponse
    {
        $this->checkAuthorization('businessRegistrationTemplate_access');
        DB::transaction(function () use ($templateTypeEnum, $businessRegistrationTemplate) {
            $this->forgotCache('businessTemplates');

            $businessRegistrationTemplate->update([
                'status' => 1
            ]);

            BusinessRegistrationTemplate::whereNot('id', $businessRegistrationTemplate->id)
                ->where('for', $templateTypeEnum->value)
                ->where('status', 1)
                ->update([
                    'status' => 0
                ]);
        });

        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }


    public function getStaticTemplate(Request $request)
    {
        $request->validate([
            'type' => ['required'],
        ]);

        return match ($request->input('type')) {
            'level1' => \View::make('businessregistration::admin.setting.template.staticTemplate.business-registration-certificate'),
            default => 'Enter Valid Type',
        };
    }


    public function enumList()
    {
        return view('businessregistration::admin.setting.template.enumList');
    }
}
