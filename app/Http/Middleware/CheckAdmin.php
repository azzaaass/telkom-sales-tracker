<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Logika: Jika user sudah login tapi role-nya bukan admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Anda tidak punya akses admin.');
        }

        // Lanjutkan permintaan jika lolos pengecekan
        return $next($request);
    }
}
