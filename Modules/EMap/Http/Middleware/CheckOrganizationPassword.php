<?php

namespace Modules\EMap\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckOrganizationPassword
{
    public function handle(Request $request, Closure $next)
    {
        if (auth('organization')->check()
            && !auth('organization')->user()->password
            && !$request->is('organization/password/create')
            && !$request->is('organization/password/store')
        ) {
            return redirect()->route('organization.password.create');
        }

        return $next($request);
    }
}
