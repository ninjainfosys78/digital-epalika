<?php

namespace Modules\Recommendation\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Recommendation\Entities\PersonalDetail;
use Modules\Recommendation\Http\Requests\PersonalDetail\StorePersonalDetailRequest;
use Modules\Recommendation\Http\Requests\PersonalDetail\UpdatePersonalDetailRequest;
use Illuminate\Database\Eloquent\Builder;

class PersonalDetailController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('personalDetail_access');
        $personalDetails = PersonalDetail::filterData()->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['name', 'phone_no', 'reg_no','gender'], request('search'));
            }
        })->latest()
            ->paginate(15);
        return view('recommendation::admin.setting.personalDetail.index', compact('personalDetails'));
    }

    public function create()
    {
        $this->checkAuthorization('personalDetail_create');
        return view('recommendation::admin.setting.personalDetail.create');
    }

    public function store(StorePersonalDetailRequest $request)
    {
        $this->checkAuthorization('personalDetail_create');
        $personalDetail = PersonalDetail::create($request->validated());
        if ($request->ajax()) {
            return response()->json([
                'data' => [
                    'personal_detail_id' => $personalDetail->id,
                    'name' => $personalDetail->name,
                    'reg_no' => $personalDetail->reg_no,
                ],
                'message' => 'व्यक्तिगत विवरण सफलतापूर्वक थपियो !'
            ]);
        }
        toast('व्यक्तिगत विवरण सफलतापूर्वक थपियो', 'success');
        return redirect()->route('admin.recommendation.setting.personalDetail.index');
    }

    public function show(PersonalDetail $personalDetail)
    {
        $this->checkAuthorization('personalDetail_access');
        $personalDetail->load('province', 'district', 'localBody', 'registrationDetails.recommendationCategory');
        return view('recommendation::admin.setting.personalDetail.show', compact('personalDetail'));
    }

    public function edit(PersonalDetail $personalDetail)
    {
        $this->checkAuthorization('personalDetail_edit');
        return view('recommendation::admin.setting.personalDetail.edit', compact('personalDetail'));
    }

    public function update(UpdatePersonalDetailRequest $request, PersonalDetail $personalDetail)
    {
        $this->checkAuthorization('personalDetail_edit');
        $personalDetail->update($request->validated());
        toast('व्यक्तिगत विवरण सफलतापूर्वक गरियो', 'success');
        return back();
    }

    public function destroy(PersonalDetail $personalDetail)
    {
        $this->checkAuthorization('personalDetail_delete');
        $personalDetail->delete();
        toast('व्यक्तिगत विवरण सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}
