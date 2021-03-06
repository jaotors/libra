<?php

namespace App\Http\Middleware;

use Closure;
use App;

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

        $header = $request->header('x-forwarded-proto') <> 'https';
        if ($header && !App::environment('local', 'staging')) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
