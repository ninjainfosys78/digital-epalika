<?php

namespace Modules\Roaster\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTraineeUserPassword
{
    public function handle(Request $request, Closure $next)
    {
        if (
            auth('traineeUser')->check()
            && !auth('traineeUser')->user()->password
            && !$request->is('roaster/traineeUser/password/create')
            && !$request->is('roaster/traineeUser/password/store')
        ) {
            return redirect()->route('roaster.traineeUser.password.create');
        }

        return $next($request);
    }
}
