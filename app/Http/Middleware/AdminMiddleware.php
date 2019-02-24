<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowedRoles = ['superuser', 'administrator'];
        $user = Auth::user();
        $roles = $user->getRoleNames();
        foreach ($roles as $role ) {
            if(in_array($role, $allowedRoles)) {
                return $next($request);
            }
        }
        abort(403, 'Unauthorized action.');
    }
}
