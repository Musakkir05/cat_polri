<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {

            if (auth()->user()->status === 'Admin') {
                return $next($request);
            } else {

                Auth::logout();
                return redirect()->route('login')->with('error', 'Anda tidak diizinkan mengakses halaman ini. Silakan login kembali.');
            }
        } else {

            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }
    }
}
