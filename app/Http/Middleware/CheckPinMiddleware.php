<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPinMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()
            && !auth()->user()->pin
            && !$request->routeIs('admin.pin.create')
            && !$request->routeIs('admin.pin.store')
        ) {
            return redirect()->route('admin.pin.create');
        }

        return $next($request);
    }
}
