<?php

namespace Artifishall\Toolbox\Middleware;

use Closure;

class DebugUser
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
        if(!\App::isLocal() && (!\Auth::check() || !\Auth::user()->can('view_debugbar'))) {
            \Debugbar::disable();
        }

        return $next($request);
    }
}
