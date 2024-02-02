<?php

namespace Modules\EMap\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\EMap\Entities\OldMap;

class OldMapController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('oldMap_access');
        $oldMaps = OldMap::with('houseOwner', 'fiscalYear')->get();
        return view('emap::admin.oldMap.index', compact('oldMaps'));
    }

    public function create()
    {
        $this->checkAuthorization('oldMap_create');
        return view('emap::admin.oldMap.create');
    }


    public function show($id)
    {
        return view('emap::show');
    }

    public function edit(OldMap $oldMap)
    {
        $this->checkAuthorization('oldMap_edit');
        $oldMap->load('houseOwner');
        return view('emap::admin.oldMap.edit', compact('oldMap'));
    }


    public function destroy(OldMap $oldMap)
    {
        $this->checkAuthorization('oldMap_delete');
        $oldMap->delete();
        toast('पुरानो नक्सा सफलतापूर्वक मेटाइयो', 'success');
        return back();
    }
}
