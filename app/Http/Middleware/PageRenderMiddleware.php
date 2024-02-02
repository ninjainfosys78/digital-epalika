<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageRenderMiddleware
{
    protected int $ttl = 60;

    public function handle(Request $request, Closure $next, $ttl = 60)
    {
        $this->ttl = $ttl;

        if (Cache::has($this->getCacheKey($request))) {
            return response(Cache::get($this->getCacheKey($request)));
        }

        return $next($request);
    }

    public function terminate(Request $request, $response): void
    {
        if (Cache::has($this->getCacheKey($request))) {
            return;
        }

        Cache::put($this->getCacheKey($request), $response->getContent(), $this->ttl);
    }

    public function getCacheKey($request): string
    {
        return md5($request->fullUrl() . '-' . auth()->id());
    }
}
