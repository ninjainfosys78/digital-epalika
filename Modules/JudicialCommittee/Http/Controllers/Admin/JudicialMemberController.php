<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\Designation;
use Illuminate\Database\Eloquent\Builder;
use Modules\JudicialCommittee\Entities\JudicialMember;
use Modules\JudicialCommittee\Http\Requests\JudicialMember\StoreJudicialMemberRequest;
use Modules\JudicialCommittee\Http\Requests\JudicialMember\UpdateJudicialMemberRequest;

class JudicialMemberController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('judicialMember_access');

        $judicialMembers = JudicialMember::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['name', 'phone', 'email', 'designation'], request('search'));
            }
        })->orderBy('position')->paginate(10);

        return view('judicialcommittee::admin.judicial_member.index', compact('judicialMembers'));
    }

    public function create()
    {
        $this->checkAuthorization('judicialMember_create');
        $designations = Designation::all();

        return view('judicialcommittee::admin.judicial_member.create', compact('designations'));
    }

    public function store(StoreJudicialMemberRequest $request)
    {
        $this->checkAuthorization('judicialMember_create');

        JudicialMember::create($request->validated());

        toast('न्यायिक सदस्य सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function edit(JudicialMember $judicialMember)
    {
        $this->checkAuthorization('judicialMember_edit');

        $designations = Designation::all();

        return view('judicialcommittee::admin.judicial_member.edit', compact('judicialMember', 'designations'));
    }

    public function update(UpdateJudicialMemberRequest $request, JudicialMember $judicialMember)
    {
        $this->checkAuthorization('judicialMember_edit');

        $judicialMember->update($request->validated());

        toast('न्यायिक सदस्य सफलतापूर्वक अपडेट गरियो', 'success');

        return redirect(route('admin.judicialCommittee.judicialMember.index'));
    }

    public function destroy(JudicialMember $judicialMember)
    {
        $this->checkAuthorization('judicialMember_delete');

        $judicialMember->delete();

        toast('न्यायिक सदस्य सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}
