<?php

namespace Artifishall\Toolbox\Middleware;

use Closure;
use Route;

class ForceSSL
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

        if (!$request->secure() && env('FORCE_SSL') === true) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
