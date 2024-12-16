<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMurid
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

            if ($request->session()->get('user')['role'] == 'Murid') {
                return $next($request);
            } else {
                return redirect('/')->with('failed', 'Akses ditolak ! Anda bukan Murid.');
            }
        }
        return redirect('/')->with('failed', 'Akses ditolak ! Anda bukan Murid.');
    }
}
