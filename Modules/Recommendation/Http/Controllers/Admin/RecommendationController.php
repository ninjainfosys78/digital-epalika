<?php

namespace Modules\Recommendation\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\OfficeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Modules\Recommendation\Entities\RecommendationFormData;
use Modules\Recommendation\Entities\RecommendationTemplate;
use Modules\Recommendation\Enums\ApplicationTypeEnum;
use Modules\Recommendation\Entities\FormBuilder;
use Modules\Recommendation\Entities\Recommendation;
use Modules\Recommendation\Http\Requests\StoreRecommendationRequest;
use Modules\Recommendation\Http\Requests\UpdateRecommendationRequest;

class RecommendationController extends Controller
{
    public function getApplicationList()
    {
        $this->checkAuthorization('recommendation_access');

        return view('recommendation::admin.application_list');
    }

    public function index(ApplicationTypeEnum $applicationTypeEnum)
    {
        $this->checkAuthorization('recommendation_access');

        $recommendations = Recommendation::with('fiscalYear')
            ->where('application_type', $applicationTypeEnum->value)
            ->latest('date_ne')
            ->paginate(10);

        return view('recommendation::admin.recommendation.index', compact('applicationTypeEnum', 'recommendations'));
    }

    public function create(ApplicationTypeEnum $applicationTypeEnum)
    {
        $this->checkAuthorization('recommendation_create');


        $definition = $this->getDefinition($applicationTypeEnum);

        if (empty($definition)) {
            return $this->redirectIfEmptyDefinition($applicationTypeEnum);
        }

        $data = '{}';

        return view('recommendation::admin.recommendation.create', compact('applicationTypeEnum', 'definition', 'data'));
    }

    public function store(StoreRecommendationRequest $request, ApplicationTypeEnum $applicationTypeEnum)
    {
        $this->checkAuthorization('recommendation_create');


        $builder = $this->getDefinition($applicationTypeEnum);

        if ($builder === null) {
            return $this->redirectIfEmptyDefinition($applicationTypeEnum);
        }

        $data = $request->validateDynamicForm(
            $builder->form,
            $request->get('submissionValues'),
            null
        );

        $recommendation = Recommendation::create([
            'application_type' => $applicationTypeEnum->value,
            'data' => $data,
            'fiscal_year_id' => OfficeSetting::latest()->first()?->fiscal_year_id ?? null,
            'date_ne' => $request->input('date_ne'),
            'date_en' => $request->input('date_en'),
            'name' => $request->input('name'),
        ]);

        toast('फारम सफलतापूर्वक थपियो', 'success');

        return redirect(route('admin.recommendation.recommendation.print', $recommendation));
    }

    public function show(ApplicationTypeEnum $applicationTypeEnum, Recommendation $recommendation)
    {
        $this->checkAuthorization('recommendation_access');

        $definition = $this->getDefinition($applicationTypeEnum);

        if ($definition === null) {
            return $this->redirectIfEmptyDefinition($applicationTypeEnum);
        }

        return view('recommendation::admin.recommendation.show', compact('applicationTypeEnum', 'recommendation', 'definition'));
    }

    public function edit(ApplicationTypeEnum $applicationTypeEnum, Recommendation $recommendation)
    {
        $this->checkAuthorization('recommendation_edit');

        $definition = $this->getDefinition($applicationTypeEnum);

        if ($definition === null) {
            return $this->redirectIfEmptyDefinition($applicationTypeEnum);
        }

        return view('recommendation::admin.recommendation.edit', compact('applicationTypeEnum', 'recommendation', 'definition'));
    }

    public function update(UpdateRecommendationRequest $request, ApplicationTypeEnum $applicationTypeEnum, Recommendation $recommendation): RedirectResponse
    {
        $this->checkAuthorization('recommendation_edit');

        $builder = $this->getDefinition($applicationTypeEnum);

        if ($builder === null) {
            return $this->redirectIfEmptyDefinition($applicationTypeEnum);
        }

        $data = $request->validateDynamicForm(
            $builder?->form,
            $request->get('submissionValues'),
            null
        );

        $recommendation->update([
            'application_type' => $applicationTypeEnum->value,
            'data' => $data,
            'fiscal_year_id' => OfficeSetting::latest()->first()?->fiscal_year_id ?? null,
            'date_ne' => $request->input('date_ne'),
            'date_en' => $request->input('date_en'),
            'name' => $request->input('name'),
        ]);


        toast('फारम सफलतापूर्वक सम्पादन भयो', 'success');

        return back();
    }

    public function destroy(ApplicationTypeEnum $applicationTypeEnum, Recommendation $recommendation): RedirectResponse
    {
        $this->checkAuthorization('recommendation_delete');

        $recommendation->delete();

        toast('फारम सफलतापूर्वक हटाइयो', 'success');

        return back();
    }

    public function getDefinition(ApplicationTypeEnum $applicationTypeEnum): null|FormBuilder
    {
        return FormBuilder::where('application_type', $applicationTypeEnum->value)->latest()->first();
    }

    public function redirectIfEmptyDefinition(ApplicationTypeEnum $applicationTypeEnum): RedirectResponse
    {
        toast('फारम बनेको छैन', 'error');
        return redirect()->route('admin.recommendation.setting.formBuilder.create', $applicationTypeEnum);
    }

    public function printRecommendation(Recommendation $recommendation)
    {
        $this->checkAuthorization('recommendation_access');

        $recommendationData = $recommendation->load('recommendationDataForm');

        $resolvedData = $recommendationData->recommendationDataForm->data ?? $this->resolve($recommendation);

        return view('recommendation::admin.recommendation.template', compact('resolvedData', 'recommendation'));
    }

    private function getData($data): array
    {
        $resolvedData = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $viewData = View::make('recommendation::admin.recommendation.templateData', compact('value'))->render();
                $resolvedData["@[$key]"] = $viewData;
            } else {
                $resolvedData["@[$key]"] = $value;
            }
        }
        return $resolvedData;
    }


    private function resolve(Recommendation $recommendation): string
    {
        $template = RecommendationTemplate::active()
            ->where('application_type', $recommendation->application_type->value)
            ->first();
        $data = collect(json_decode($recommendation->data));
        $replace = $this->getData($data);
        return Str::replace(array_keys($replace), $replace, $template->data);
    }

    public function formData(Request $request, Recommendation $recommendation)
    {
        $data = $request->validate([
            'data' => 'required'
        ]);
        RecommendationFormData::updateOrCreate(
            [
                'recommendation_id' => $recommendation->id,
            ],
            [
                'data' => $data['data'],
                'update_times' => empty($recommendation->recommendationDataForm) ? 0 : $recommendation->recommendationDataForm->update_times + 1
            ]
        );
        toast('डाटा सफलतापूर्वक थपियो', 'success');
        return back();
    }
}
