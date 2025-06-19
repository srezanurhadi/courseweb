<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        if ($request->expectsJson()) {
        // Jika ya, jangan redirect. Kembalikan respons error dalam format JSON
        // dengan status 401 (Unauthorized) atau 403 (Forbidden).
        return response()->json(['message' => 'Akses ditolak.'], 403);
    }
    
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
