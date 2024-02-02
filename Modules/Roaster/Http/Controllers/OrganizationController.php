<?php

namespace Modules\Roaster\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TraineeUserRegistered;
use Modules\Roaster\Entities\TraineeUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class OrganizationController extends Controller
{
    public function index()
    {

        $organizations = TraineeUser::with('traineeUserDetail.province', 'traineeUserDetail.district')
            ->where(function (Builder $q) {
                if (!is_null(request('search'))) {
                    $q->whereLike(['email', 'phone', 'name'], request('search'));
                }
            })
            ->latest()->paginate(10);
        return view('roaster::admin.organization.index', compact('organizations'));
    }

    public function updateLoginStatus(TraineeUser $traineeUser)
    {

        DB::transaction(function () use ($traineeUser) {
            $traineeUser->update([
                'is_active' => !$traineeUser->is_active,
            ]);
            if (empty($traineeUser->password) && $traineeUser->is_active == 1) {
                $url = URL::signedRoute('roaster.traineeUser.invitation', $traineeUser);
                Mail::to($traineeUser->email)->send(new TraineeUserRegistered($traineeUser, $url));
            }
        });

        toast('संगठन स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    public function show($id)
    {
        return view('roaster::show');
    }

    public function destroy(TraineeUser $traineeUser)
    {

        $traineeUser->delete();
        toast(' संगठन सफलतापूर्वक मेटाइयो', 'success');
        return back();
    }
}
