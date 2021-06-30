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
        $length = config('hashids.connections.main.length');

        foreach ($request->route()->parameters() as $name => $parameter) {
            if (!is_numeric($parameter) && strlen($parameter) === $length) {
                $request->route()->setParameter($name, current(Hashids::decode($parameter)));
            }
        }
        foreach ($request->input() as $key => $value) {
            if (!is_numeric($value) && strlen($value) === $length) {
                $request->offsetSet($key, current(Hashids::decode($value)));
            }
        }

        return $next($request);
    }
}
