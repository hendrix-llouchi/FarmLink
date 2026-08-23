<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * VerifyResourceOwnership
 *
 * Prevents IDOR (Insecure Direct Object Reference) attacks by ensuring the
 * authenticated user is the owner of the resource they are attempting to mutate.
 *
 * Usage in routes:
 *   ->middleware('owns.resource:orders,buyer_id')
 *   ->middleware('owns.resource:products,user_id')
 *
 * The middleware resolves the record ID from the first route parameter.
 */
class VerifyResourceOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  string  $table   The database table to query (e.g. 'orders', 'products')
     * @param  string  $column  The owner column on that table (e.g. 'buyer_id', 'user_id')
     */
    public function handle(Request $request, Closure $next, string $table, string $column): Response
    {
        // Resolve the resource ID from the first route segment parameter
        $resourceId = collect($request->route()->parameters())->first();

        if (! $resourceId) {
            abort(400, 'Resource identifier missing.');
        }

        $record = DB::table($table)->where('id', $resourceId)->first();

        if (! $record) {
            abort(404, 'Resource not found.');
        }

        if ((int) $record->$column !== (int) auth()->id()) {
            abort(403, 'You do not have permission to perform this action.');
        }

        return $next($request);
    }
}
