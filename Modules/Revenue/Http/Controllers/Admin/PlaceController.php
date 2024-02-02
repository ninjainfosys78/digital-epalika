<?php

namespace Modules\Revenue\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Revenue\Entities\Place;
use Modules\Revenue\Entities\Sector;
use Modules\Revenue\Http\Requests\StorePlaceRequest;
use Modules\Revenue\Http\Requests\UpdatePlaceRequest;

class PlaceController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('place_access');
        $places = Place::with('sector')->latest()->get();
        return view('revenue::admin.setting.place.index', compact('places'));
    }

    public function create()
    {
        $this->checkAuthorization('place_create');
        $sectors = Sector::latest()->get();
        return view('revenue::admin.setting.place.create', compact('sectors'));
    }

    public function store(StorePlaceRequest $request)
    {
        $this->checkAuthorization('place_create');

        Place::create($request->validated());

        toast('जग्गाको मुल्यांकन सफलतापुर्वक राखियो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->back();
    }


    public function edit(Place $place)
    {
        $this->checkAuthorization('place_edit');
        $sectors = Sector::latest()->get();
        return view('revenue::admin.setting.place.edit', compact('place', 'sectors'));
    }

    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $this->checkAuthorization('place_edit');

        $place->update($request->validated());

        toast('जग्गाको मुल्यांकन सफलतापुर्वक अपडेट भयो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.place.index');
    }

    public function destroy(Place $place)
    {
        $this->checkAuthorization('place_delete');

        $place->delete();

        toast('जग्गाको मुल्यांकन सफलतापुर्वक हटाइयो', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('admin.revenue.setting.place.index');
    }
}
