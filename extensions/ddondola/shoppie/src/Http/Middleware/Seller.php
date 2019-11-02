<?php

namespace Shoppie\Http\Middleware;

use Closure;
use Shoppie\Shop;

class Seller
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
        if (!$request->user()->can('create', Shop::class))
            return redirect()->to('/');

        return $next($request);
    }
}
