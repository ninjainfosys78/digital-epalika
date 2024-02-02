<?php

namespace Modules\Revenue\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Revenue\Entities\Sector;
use Modules\Revenue\Http\Requests\StoreSectorRequest;
use Modules\Revenue\Http\Requests\UpdateSectorRequest;

class SectorController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('sector_access');
        $sectors = Sector::latest()->get();
        return view('revenue::admin.setting.sector.index', compact('sectors'));
    }

    public function create()
    {
        $this->checkAuthorization('sector_create');
        return view('revenue::admin.setting.sector.create');
    }

    public function store(StoreSectorRequest $request)
    {
        $this->checkAuthorization('sector_create');

        Sector::create($request->validated());

        toast('क्षेत्र सफलतापुर्वक राखियो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->back();
    }

    public function edit(Sector $sector)
    {
        $this->checkAuthorization('sector_edit');
        return view('revenue::admin.setting.sector.edit', compact('sector'));
    }

    public function update(UpdateSectorRequest $request, Sector $sector)
    {
        $this->checkAuthorization('sector_edit');

        $sector->update($request->validated());

        toast('क्षेत्र सफलतापुर्वक अपडेट भयो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.sector.index');
    }

    public function destroy(Sector $sector)
    {
        $this->checkAuthorization('sector_delete');

        $sector->delete();

        toast('क्षेत्र सफलतापुर्वक हटाइयो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.sector.index');
    }
}
