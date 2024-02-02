<?php

namespace Modules\EMap\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\EMap\Entities\MapPassGroup;
use Modules\EMap\Http\Requests\MapPassGroup\StoreMapPassGroupRequest;
use Modules\EMap\Http\Requests\MapPassGroup\UpdateMapPassGroupRequest;

class MapPassGroupController extends Controller
{
    public function index()
    {
        $mapPassGroups = MapPassGroup::withCount('users')->latest()->get();
        return view('emap::admin.mapPassGroup.index', compact('mapPassGroups'));
    }

    public function create()
    {
        $users = User::get();
        return view('emap::admin.mapPassGroup.create', compact('users'));
    }

    public function store(StoreMapPassGroupRequest $request)
    {

        DB::transaction(function () use ($request) {

            $mapPassGroup = MapPassGroup::create($request->validated());
            foreach ($request->validated()['users'] as $userData) {
                $user = User::find($userData['user_id']);
                $wardNos = $userData['ward_no'];
                $mapPassGroup->users()->attach($user, ['ward_no' => implode(',', $wardNos)]);
            }
        });

        toast('नक्शा पास समूह थपियो', 'success');
        return back();
    }

    public function show($id)
    {
        return view('emap::show');
    }

    public function edit(MapPassGroup $mapPassGroup)
    {
        $mapPassGroup->load('users');
        $users = User::get();
        return view('emap::admin.mapPassGroup.edit', compact('mapPassGroup', 'users'));
    }

    public function update(UpdateMapPassGroupRequest $request, MapPassGroup $mapPassGroup)
    {
        DB::transaction(function () use ($request, $mapPassGroup) {
            $mapPassGroup->update($request->validated());
            foreach ($request->input('users') as $userId) {
                $wardNos = $userId['ward_no'];
                $condition = [
                    'user_id' => $userId['user_id'],
                    'map_pass_group_id' => $mapPassGroup->id,
                ];
                $newWardNo = implode(',', $wardNos);
                DB::table('map_pass_group_user')
                    ->where($condition)
                    ->update(['ward_no' => $newWardNo]);
            }
        });

        toast('नक्शा पास समूह सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    public function destroy(MapPassGroup $mapPassGroup)
    {
        if ($mapPassGroup->status) {
            toast('सक्रिय भएको नक्शा पास समूह मेटाउन मनाहि छ', 'error');
            return back();
        }
        $mapPassGroup->users()->detach($mapPassGroup->load('users')->users->pluck('id')->toArray() ?? []);
        $mapPassGroup->delete();
        toast('नक्शा पास समूह मेटियो', 'success');
        return back();
    }

    public function updateStatus(MapPassGroup $mapPassGroup)
    {
        $this->checkAuthorization('recommendationTemplate_access');

        $mapPassGroup->update([
            'status' => !$mapPassGroup->status
        ]);
        toast('नक्शा पास समूह सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }
}