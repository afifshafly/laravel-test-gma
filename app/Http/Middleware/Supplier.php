<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;

class Supplier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 'supplier') {
            return $next($request);
        }

        if (Auth::user()->role == 'toko') {
            return redirect()->route('toko');
        }

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin');
        }
    }
}
