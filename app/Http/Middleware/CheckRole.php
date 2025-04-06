<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check() || !auth()->user()->hasRole($role)) {
            abort(403, 'Accès interdit');
        }

        return $next($request);
    }

}
