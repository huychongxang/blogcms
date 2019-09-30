<?php

namespace App\Http\Middleware;

use App\Post;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!checkUserPermissions($request)) {
            abort(403, 'Forbidden access');
        }
        return $next($request);
    }
}
