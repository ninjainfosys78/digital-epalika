<?php

namespace Modules\GrievanceHandling\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Modules\GrievanceHandling\Entities\GrievanceType;
use Modules\GrievanceHandling\Http\Requests\GrievanceType\StoreGrievanceTypeRequest;
use Modules\GrievanceHandling\Http\Requests\GrievanceType\UpdateGrievanceTypeRequest;

class GrievanceTypeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('grievanceType_access');

        $grievance_types = GrievanceType::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['grievanceOffice'], request('search'));
            }
        })->latest()->paginate(10);

        return view('grievancehandling::admin.setting.grievance_type.index', compact('grievance_types'));
    }

    public function create()
    {
        $this->checkAuthorization('grievanceType_create');

        return view('grievancehandling::admin.setting.grievance_type.create');
    }

    public function store(StoreGrievanceTypeRequest $request)
    {
        $this->checkAuthorization('grievanceType_create');

        GrievanceType::create($request->validated());
        toast('गुनासो प्रकार  सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(GrievanceType $grievanceType)
    {
        $this->checkAuthorization('grievanceType_access');

        return view('grievancehandling::admin.setting.grievance_type.show');
    }

    public function edit(GrievanceType $grievanceType)
    {
        $this->checkAuthorization('grievanceType_edit');

        return view('grievancehandling::admin.setting.grievance_type.edit', compact('grievanceType'));
    }

    public function update(UpdateGrievanceTypeRequest $request, GrievanceType $grievanceType)
    {
        $this->checkAuthorization('grievanceType_edit');

        $grievanceType->update($request->validated());
        toast('गुनासो प्रकार सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.grievanceHandling.setting.grievanceType.index'));
    }

    public function destroy(GrievanceType $grievanceType)
    {
        $this->checkAuthorization('grievanceType_delete');
        $grievanceType->delete();
        toast(' गुनासो प्रकार सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}
