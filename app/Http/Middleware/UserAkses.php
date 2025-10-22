<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAkses
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return $this->unauthorizedResponse('User not authenticated');
        }

        if (!Auth::user()->role) {
            return $this->unauthorizedResponse('User has no role assigned');
        }

        $userRole = Auth::user()->role->name;
        
        // Cek jika user role ada dalam list roles yang diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        return $this->unauthorizedResponse();
    }

    private function unauthorizedResponse()
    {
        return response()->view('errors.unauthorized', [
            'message' => 'Kamu tidak memiliki akses untuk halaman ini 🚫'
        ], 403);
    }
}