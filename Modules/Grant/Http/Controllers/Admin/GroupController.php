<?php

namespace Modules\Grant\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Grant\Entities\Group;
use Modules\Grant\Http\Requests\Group\StoreGroupRequest;
use Modules\Grant\Http\Requests\Group\UpdateGroupRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\Grant\Entities\Farmer;
use Modules\Grant\Entities\GrantProgram;

class GroupController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('group_access');

        $groups = Group::with('province', 'district', 'localBody', 'grantDetails.localBody')
        ->where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['unique_id', 'name', 'vat_pan', 'registration_date',], request('search'));
            }
            if (!auth()->user()?->load('role')?->role?->type == 'Super') {
                $q->where('user_id', auth()->id());
            }
        })
            ->latest()->paginate(10);

        return view('grant::admin.group.index', compact('groups'));
    }

    public function create()
    {
        $this->checkAuthorization('group_create');

        $farmers = Farmer::latest()->get();

        return view('grant::admin.group.create', compact('farmers'));
    }

    public function store(StoreGroupRequest $request)
    {
        $this->checkAuthorization('group_create');

        $group = DB::transaction(function () use ($request) {
            $group = Group::create($request->validated() + [
                    'registration_date' => $request->input('g_registration_date')
                ]);

            $group->farmers()->attach($request->input('farmers'));

            return $group;
        });

        if ($request->ajax()) {
            return response()->json([
                'data' => [
                    'group_id' => $group->id,
                    'group_name' => $group->name
                ],
                'message' => 'group Added Successfully'
            ]);
        }

        toast('समूह सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function edit(Group $group)
    {
        $this->checkAuthorization('group_edit');

        $farmers = Farmer::latest()->get();
        $group->load('farmers');

        return view('grant::admin.group.edit', compact('farmers', 'group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $this->checkAuthorization('group_edit');

        $group->update($request->validated());

        DB::transaction(function () use ($request, $group) {
            $group->update($request->validated());

            $group->farmers()->sync($request->input('farmers'));
        });

        toast('समूह सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.grant.group.index'));
    }

    public function destroy(Group $group)
    {
        $this->checkAuthorization('group_delete');

        $group->farmers()->detach();
        $group->delete();

        toast('समूह सफलतापूर्वक मेटाइयो', 'success');
        return back();
    }

    public function show(Group $group)
    {
        $this->checkAuthorization('group_access');

        $group->load('province', 'district', 'localBody', 'farmers', 'grantDetails.grant.grantProgram', 'grantDetails.localBody');
        $grantPrograms = GrantProgram::all();

        return view('grant::admin.group.show', compact('group', 'grantPrograms'));
    }

    public function grantDetails(Group $group)
    {
        $this->checkAuthorization('group_access');

        $group->load('grantDetails.grant.grantProgram');

        return view('grant::admin.group.grant_details', compact('group'));
    }
}
