<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Siswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna memiliki status 'Siswa'
        if (auth()->check() && auth()->user()->status === 'Siswa') {
            return $next($request);
        }

        // Jika tidak, redirect atau melakukan tindakan lainnya
        Auth::logout();
        return redirect()->route('login')->with('error', 'Anda tidak diizinkan mengakses halaman ini. Silakan login kembali.');
    }
}
