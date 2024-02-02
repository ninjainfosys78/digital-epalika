<?php

namespace Modules\Recommendation\Http\Controllers;

use App\Traits\NepaliDateConverter;
use App\Http\Controllers\Controller;
use Modules\Recommendation\Entities\RecommendationCategory;
use Modules\Recommendation\Http\Requests\RecommendationCategory\StoreRecommendationCategoryRequest;
use Modules\Recommendation\Http\Requests\RecommendationCategory\UpdateRecommendationCategoryRequest;

class RecommendationCategoryController extends Controller
{
    use NepaliDateConverter;

    public function index($type)
    {
        $this->checkAuthorization('recommendationCategory_access');
        $recommendationCategories = RecommendationCategory::with('recommendationCategory')->withCount(['recommendationCategories'])->where(function ($query) use ($type) {
            if ($type == 'recommendationSubCategory') {
                $query->whereNotNull('recommendation_category_id');
            } else {
                $query->whereNull('recommendation_category_id');
            }
        })->get();

        return view('recommendation::admin.setting.recommendationcategory.index', compact('recommendationCategories', 'type'));
    }

    public function create($type)
    {
        $this->checkAuthorization('recommendationCategory_create');
        $recommendationCategories = RecommendationCategory::whereNull('recommendation_category_id')->get();
        return view('recommendation::admin.setting.recommendationcategory.create', compact('type', 'recommendationCategories'));
    }

    public function store(StoreRecommendationCategoryRequest $request, $type)
    {
        $this->checkAuthorization('recommendationCategory_create');
        RecommendationCategory::create($request->validated() + [
                'user_id' => auth()->id(),
            ]);
        toast('सिफारिस सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show($type, RecommendationCategory $recommendationCategory)
    {
        $this->checkAuthorization('recommendationCategory_access');
        return view('recommendation::admin.setting.recommendationcategory.show', compact('recommendationCategory', 'type'));
    }

    public function edit($type, RecommendationCategory $recommendationCategory)
    {
        $this->checkAuthorization('recommendationCategory_edit');
        $recommendationCategories = RecommendationCategory::whereNull('recommendation_category_id')->get();
        return view('recommendation::admin.setting.recommendationcategory.edit', compact('type', 'recommendationCategory', 'recommendationCategories'));
    }

    public function update(UpdateRecommendationCategoryRequest $request, $type, RecommendationCategory $recommendationCategory)
    {
        $this->checkAuthorization('recommendationCategory_edit');
        $recommendationCategory->update($request->validated());
        toast('सिफारिस सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function destroy($type, RecommendationCategory $recommendationCategory)
    {
        $this->checkAuthorization('recommendationCategory_delete');
        if ($recommendationCategory->is_active == 1) {
            toast('सक्रिय भएको सिफारिस प्रकार मेटाउन मनाहि छ', 'error');

            return back();
        }
        $recommendationCategory->delete();
        toast('सिफारिस सफलतापूर्वक मेटियो', 'success');
        return back();
    }

    public function updateStatus($type, RecommendationCategory $recommendationCategory)
    {
        $this->checkAuthorization('recommendationCategory_access');
        $recommendationCategory->update([
            'is_active' => !$recommendationCategory->is_active
        ]);

        toast('टेम्प्लेट स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }
}
