<?php

namespace App\Http\Middleware;

use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards) {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check() && $guard === 'web') {
                return redirect()->route('home');
            } else

            if (Auth::guard($guard)->check() && $guard === 'admin') {
                return redirect()->route('admin.dashboard');
            } else

            if (Auth::guard($guard)->check() && $guard === 'customer') {
                session()->forget('shop_id');
                Cart::destroy();

                return redirect()->route('customer.shop.list');
            }

        }

        return $next($request);
    }

}
