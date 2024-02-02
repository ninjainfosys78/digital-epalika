<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\EMap\Entities\Renewed;
use Modules\EMap\Http\Requests\Renewed\StoreRenewedRequest;

class RenewedController extends Controller
{
    public function index()
    {
        $reneweds = Renewed::where('organization_detail_id', auth('organization')
        ->user()->organizationDetail->id)
        ->latest()
        ->get();
        return view('admin.global.organization.renewed.index',compact('reneweds'));
    }

    public function create()
    {
        return view('admin.global.organization.renewed.create');
    }

    public function store(StoreRenewedRequest $request)
    {
        Renewed::create($request->validated()+ [
            'organization_detail_id' => auth('organization')->user()->organizationDetail->id,
        ]);
        toast('नविकरण सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function destroy(Renewed $renewed)
    {
        $renewed->delete();
        toast('नविकरण सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}
