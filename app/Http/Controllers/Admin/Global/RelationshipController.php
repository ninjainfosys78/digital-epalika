<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Relationship\StoreRelationshipRequest;
use App\Http\Requests\Setting\Relationship\UpdateRelationshipRequest;
use App\Models\Settings\Relationship;
use Illuminate\Http\RedirectResponse;

class RelationshipController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('relationship_access');
        $relationships = Relationship::latest()->paginate(10);
        return view('admin.global.relationship.index', compact('relationships'));
    }

    public function create()
    {
        $this->checkAuthorization('relationship_create');
        return view('admin.global.relationship.create');
    }

    public function store(StoreRelationshipRequest $request): RedirectResponse
    {
        $this->checkAuthorization('relationship_create');
        Relationship::create($request->validated());
        toast('नाता सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(Relationship $relationship)
    {
        $this->checkAuthorization('relationship_access');
        return view('show');
    }

    public function edit(Relationship $relationship)
    {
        $this->checkAuthorization('relationship_edit');
        return view('admin.global.relationship.edit', compact('relationship'));
    }

    public function update(UpdateRelationshipRequest $request, Relationship $relationship)
    {
        $this->checkAuthorization('relationship_edit');
        $relationship->update($request->validated());
        toast('नाता सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.global.relationship.index'));
    }

    public function destroy(Relationship $relationship): RedirectResponse
    {
        $this->checkAuthorization('relationship_delete');
        $relationship->delete();
        toast('नाता सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}
