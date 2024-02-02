<?php

namespace Modules\Recommendation\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Recommendation\Entities\RecommendationCategory;
use Modules\Recommendation\Entities\RecommendationTemplate;
use Modules\Recommendation\Http\Requests\Template\StoreRecommendationTemplateRequest;
use Modules\Recommendation\Http\Requests\Template\UpdateRecommendationTemplateRequest;

class RecommendationTemplateController extends Controller
{
    public function index($type, RecommendationCategory $recommendationCategory)
    {
        $this->checkAuthorization('recommendationTemplate_access');

        $recommendationTemplates = RecommendationTemplate::where('recommendation_category_id', $recommendationCategory->id)->latest()->get();
        return view('recommendation::admin.setting.recommendationTemplate.index', compact('type', 'recommendationTemplates', 'recommendationCategory'));
    }

    public function create($type, RecommendationCategory $recommendationCategory)
    {
        $this->checkAuthorization('recommendationTemplate_create');
        return view('recommendation::admin.setting.recommendationTemplate.create', compact('type', 'recommendationCategory'));
    }

    public function store(StoreRecommendationTemplateRequest $request, $type, RecommendationCategory $recommendationCategory)
    {
        $this->checkAuthorization('recommendationTemplate_create');

        RecommendationTemplate::create($request->validated() + [
                'user_id' => auth()->id(),
                'recommendation_category_id' => $recommendationCategory->id,
                'is_active' => RecommendationTemplate::where('is_active', 1)
                    ->where('recommendation_category_id', $recommendationCategory->id)
                    ->count() === 0 ? '1' : '0'
            ]);
        toast('टेम्प्लेट सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show($type, RecommendationCategory $recommendationCategory, RecommendationTemplate $recommendationTemplate)
    {
        $this->checkAuthorization('recommendationTemplate_access');
        return view('recommendation::show', compact('recommendationTemplate', 'recommendationCategory', 'type'));
    }

    public function edit($type, RecommendationCategory $recommendationCategory, RecommendationTemplate $recommendationTemplate)
    {
        $this->checkAuthorization('recommendationTemplate_edit');
        return view('recommendation::admin.setting.recommendationTemplate.edit', compact('type', 'recommendationTemplate', 'recommendationCategory'));
    }

    public function update(UpdateRecommendationTemplateRequest $request, $type, RecommendationCategory $recommendationCategory, RecommendationTemplate $recommendationTemplate)
    {
        $this->checkAuthorization('recommendationTemplate_edit');

        $recommendationTemplate->update($request->validated());
        toast('टेम्प्लेट सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    public function destroy($type, RecommendationCategory $recommendationCategory, RecommendationTemplate $recommendationTemplate)
    {
        $this->checkAuthorization('recommendationTemplate_delete');
        if ($recommendationTemplate->is_active == 1) {
            toast('सक्रिय भएको टेम्प्लेट मेटाउन मनाहि छ', 'error');
            return back();
        }

        $recommendationTemplate->delete();
        toast('टेम्प्लेट सफलतापूर्वक मेटियो', 'success');
        return back();
    }

    public function updateStatus($type, RecommendationCategory $recommendationCategory, RecommendationTemplate $recommendationTemplate)
    {
        $this->checkAuthorization('recommendationTemplate_access');
        DB::transaction(function () use ($recommendationTemplate, $recommendationCategory) {
            $recommendationTemplate->update([
                'is_active' => 1
            ]);
            RecommendationTemplate::whereNot('id', $recommendationTemplate->id)
                ->where('is_active', 1)
                ->where('recommendation_category_id', $recommendationCategory->id)
                ->update([
                    'is_active' => 0
                ]);
        });
        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }
}
