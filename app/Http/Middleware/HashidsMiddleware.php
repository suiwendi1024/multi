<?php

namespace App\Http\Middleware;

use Closure;
use Vinkla\Hashids\Facades\Hashids;

class HashidsMiddleware
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
        foreach ($request->route()->parameters() as $name => $parameter) {
            if (!is_numeric($parameter)) {
                $request->route()->setParameter($name, current(Hashids::decode($parameter)));
            }
        }

        return $next($request);
    }
}
