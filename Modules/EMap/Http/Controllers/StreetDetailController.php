<?php

namespace Modules\EMap\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\EMap\Entities\StreetDetail;
use Modules\EMap\Http\Requests\StreetDetail\StoreStreetDetailRequest;
use Modules\EMap\Http\Requests\StreetDetail\UpdateStreetDetailRequest;

class StreetDetailController extends Controller
{
    public function index()
    {
        $streetDetails = StreetDetail::latest()->get();
        return view('emap::admin.street_detail.index', compact('streetDetails'));
    }

    public function create()
    {
        return view('emap::admin.street_detail.create');

    }

    public function store(StoreStreetDetailRequest $request)
    {
        StreetDetail::create($request->validated());
        toast('सडक विवरण थपियो', 'success');
        return back();
    }

    public function show($id)
    {

    }

    public function edit(StreetDetail $streetDetail)
    {
        return view('emap::admin.street_detail.edit', compact('streetDetail'));

    }

    public function update(UpdateStreetDetailRequest $request, streetDetail $streetDetail)
    {
        $streetDetail->update($request->validated());
        toast('सडक विवरण सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('emap.admin.streetDetail.index'));
    }

    public function destroy(streetDetail $streetDetail)
    {
        $streetDetail->delete();
        toast('सडक विवरण मेटियो', 'success');
        return back();
    }
}
