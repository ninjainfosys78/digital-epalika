<?php

namespace Modules\Revenue\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Revenue\Entities\PhysicalStructureType;
use Modules\Revenue\Http\Requests\StorePhysicalStructureTypeRequest;
use Modules\Revenue\Http\Requests\UpdatePhysicalStructureTypeRequest;

class PhysicalStructureTypeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('physicalStructureType_access');
        $physicalStructureTypes = PhysicalStructureType::latest()->get();
        return view('revenue::admin.setting.physical-structure-type.index', compact('physicalStructureTypes'));
    }

    public function create()
    {
        $this->checkAuthorization('physicalStructureType_create');
        return view('revenue::admin.setting.physical-structure-type.create');
    }

    public function store(StorePhysicalStructureTypeRequest $request)
    {
        $this->checkAuthorization('physicalStructureType_create');

        PhysicalStructureType::create($request->validated());

        toast('स्ट्रकचर सफलतापुर्वक राखियो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->back();
    }

    public function edit(PhysicalStructureType $physicalStructureType)
    {
        $this->checkAuthorization('physicalStructureType_edit');
        return view('revenue::admin.setting.physical-structure-type.edit', compact('physicalStructureType'));
    }

    public function update(UpdatePhysicalStructureTypeRequest $request, PhysicalStructureType $physicalStructureType)
    {
        $this->checkAuthorization('physicalStructureType_edit');

        $physicalStructureType->update($request->validated());

        toast('स्ट्रकचर सफलतापुर्वक अपडेट भयो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.physicalStructureType.index');
    }

    public function destroy(PhysicalStructureType $physicalStructureType)
    {
        $this->checkAuthorization('physicalStructureType_delete');

        $physicalStructureType->delete();

        toast('स्ट्रकचर सफलतापुर्वक हटाइयो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.physicalStructureType.index');
    }
}
