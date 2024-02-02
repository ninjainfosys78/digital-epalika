<?php

namespace Modules\GrievanceHandling\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Modules\GrievanceHandling\Entities\GrievanceUser;
use Illuminate\Database\Eloquent\Builder;
use Modules\GrievanceHandling\Http\Requests\GrievanceUser\StoreGrievanceUserRequest;
use Modules\GrievanceHandling\Http\Requests\GrievanceUser\UpdateGrievanceUserRequest;

class GrievanceUserController extends Controller
{
    public function index(): Factory|View|Application
    {
        $this->checkAuthorization('grievanceUser_access');

        $grievanceUsers = GrievanceUser::withCount('grievanceDetails')
            ->where(function (Builder $q) {
                if (!is_null(request('search'))) {
                    $q->whereLike(['name', 'email', 'phone'], request('search'));
                }
            })
            ->latest()->paginate(10);


        return view('grievancehandling::admin.user.index', compact('grievanceUsers'));
    }

    public function create()
    {
        return view('grievancehandling::admin.user.create');
    }

    public function store(StoreGrievanceUserRequest $request)
    {
        $this->checkAuthorization('grievanceUser_create');

        $grievanceUser = GrievanceUser::create($request->validated());

        if ($request->ajax()) {
            return response()->json([
                'data' => $grievanceUser,
                'message' => 'गुनासो प्रयोगकर्ता सफलतापूर्वक थपियो'
            ]);
        }

        toast('गुनासो प्रयोगकर्ता सफलतापूर्वक थपियो', 'success');
        return redirect(route('admin.grievanceHandling.grievanceUser.index'));
    }

    public function show(GrievanceUser $grievanceUser): Factory|View|Application
    {
        $this->checkAuthorization('grievanceUser_access');

        $grievanceUser->loadCount('grievanceDetails');

        return view('grievancehandling::admin.user.show', compact('grievanceUser'));
    }

    public function edit(GrievanceUser $grievanceUser)
    {
        return view('grievancehandling::admin.user.edit', compact('grievanceUser'));
    }

    public function update(UpdateGrievanceUserRequest $request, GrievanceUser $grievanceUser)
    {
        $this->checkAuthorization('grievanceUser_edit');

        $grievanceUser->update($request->validated());

        toast('गुनासो प्रयोगकर्ता सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.grievanceHandling.grievanceUser.index'));
    }

    public function destroy(GrievanceUser $grievanceUser)
    {
        $this->checkAuthorization('grievanceUser_delete');

        $grievanceUser->delete();

        toast('गुनासो प्रयोगकर्ता सफलतापूर्वक हटाइयो', 'success');
        return back();
    }
}
