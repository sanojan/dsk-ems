<?php

namespace App\Http\Middleware;

use Closure;

class CheckDenied
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
        if (!auth()->user()->updated_at) {
            return redirect()->route('denial');
        }

        return $next($request);
    }
}
