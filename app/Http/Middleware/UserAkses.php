<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAkses
{
   public function handle(Request $request, Closure $next, $role): Response
{
    if (Auth::check() && Auth::user()->role && Auth::user()->role->name === $role) {
        return $next($request);
    }

    // Render ke view error unauthorized
    return response()->view('errors.unauthorized', [
        'message' => 'Kamu tidak memiliki akses untuk halaman ini 🚫'
    ], 403);
}
}
