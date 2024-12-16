<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('user')) {
            // dd($request->session()->get('user')['role']);

            if ($request->session()->get('user')['role'] == 'Admin') {
                return $next($request);
            } else {
                return redirect('/')->with('failed', 'Akses ditolak ! Anda bukan Admin.');
            }
        }
        return redirect('/')->with('failed', 'Akses ditolak ! Anda bukan Admin.');
    }
}
