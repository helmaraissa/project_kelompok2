<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login'); // belum login
        }

        $user = Auth::user();
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized'); // tidak punya akses
        }

        return $next($request);
    }
}
