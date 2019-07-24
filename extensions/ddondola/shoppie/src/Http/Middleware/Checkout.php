<?php

namespace Shoppie\Http\Middleware;

use Closure;

class Checkout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->cart->isEmpty())
            return redirect()->route('my.cart');

        return $next($request);
    }
}
