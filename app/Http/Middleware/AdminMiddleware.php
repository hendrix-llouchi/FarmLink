<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless($request->user()?->is_admin && !$request->user()?->suspended_at, 403, 'Admin access required.');
        return $next($request);
    }
}
