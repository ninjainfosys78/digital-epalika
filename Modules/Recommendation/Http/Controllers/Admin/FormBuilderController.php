<?php

namespace Modules\Recommendation\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\Recommendation\Entities\FormBuilder;
use Modules\Recommendation\Entities\RecommendationTemplate;
use Modules\Recommendation\Enums\ApplicationTypeEnum;
use Modules\Recommendation\Http\Requests\StoreFormBuilderRequest;
use Modules\Recommendation\Http\Requests\UpdateFormBuilderRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FormBuilderController extends Controller
{
    public function index(ApplicationTypeEnum $applicationTypeEnum)
    {
        $this->checkAuthorization('formBuilder_access');

        $formBuilders = FormBuilder::where('application_type', $applicationTypeEnum->value)->latest()->get();
        $recommendationTemplates = RecommendationTemplate::where('application_type', $applicationTypeEnum->value)->latest()->get();
        return view('recommendation::admin.setting.form-builder.index', compact('formBuilders', 'recommendationTemplates', 'applicationTypeEnum'));
    }

    public function create(ApplicationTypeEnum $applicationTypeEnum)
    {
        $this->checkAuthorization('formBuilder_create');

        return view('recommendation::admin.setting.form-builder.create', compact('applicationTypeEnum'));
    }

    public function store(StoreFormBuilderRequest $request, ApplicationTypeEnum $applicationTypeEnum): RedirectResponse
    {
        $this->checkAuthorization('formBuilder_create');

        FormBuilder::create($request->validated() + [
                'application_type' => $applicationTypeEnum->value,
                'status' => FormBuilder::where('application_type', $applicationTypeEnum->value)
                    ->where('status', 1)
                    ->count() === 0 ? '1' : '0'
            ]);

        toast('फारम सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(ApplicationTypeEnum $applicationTypeEnum, FormBuilder $formBuilder)
    {
        $this->checkAuthorization('formBuilder_access');

        $data = '{}';
        return view('recommendation::admin.setting.form-builder.show', compact([
            'formBuilder',
            'data',
            'applicationTypeEnum'
        ]));
    }

    public function edit(ApplicationTypeEnum $applicationTypeEnum, FormBuilder $formBuilder)
    {
        abort_if(
            Gate::denies('formBuilder_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $data = '{}';
        return view('recommendation::admin.setting.form-builder.edit', compact([
            'formBuilder',
            'data',
            'applicationTypeEnum'
        ]));
    }

    public function update(UpdateFormBuilderRequest $request, ApplicationTypeEnum $applicationTypeEnum, FormBuilder $formBuilder)
    {
        $this->checkAuthorization('formBuilder_edit');

        $formBuilder->update($request->validated());

        toast('फारम सफलतापूर्वक सम्पादन भयो', 'success');

        return back();
    }

    public function destroy(ApplicationTypeEnum $applicationTypeEnum, FormBuilder $formBuilder)
    {
        $this->checkAuthorization('formBuilder_delete');
        if ($formBuilder->status == 1) {
            toast('Error while deleting file', 'error');

            return back();
        }
        $formBuilder->delete();

        toast('फारम सफलतापूर्वक हटाइयो', 'success');

        return back();
    }

    public function updateStatus(ApplicationTypeEnum $applicationTypeEnum, FormBuilder $formBuilder)
    {
        $this->checkAuthorization('formBuilder_access');

        DB::transaction(function () use ($formBuilder, $applicationTypeEnum) {
            $formBuilder->update([
                'status' => 1
            ]);
            FormBuilder::whereNot('id', $formBuilder->id)->where('application_type', $applicationTypeEnum->value)->where('status', 1)->update([
                'status' => 0
            ]);
        });

        toast('फारम बिल्डर स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }
}
