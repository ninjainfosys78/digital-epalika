<?php

namespace Modules\Roaster\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TraineeUserDashboardController extends Controller
{
    public function __invoke(Request $request)
    {

        return view('roaster::traineeUser.dashboard');
    }
}
