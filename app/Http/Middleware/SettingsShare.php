<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SettingsShare
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
        $coreSetting = \App\Models\Settings::coreSetting()->value;
        view()->share('coreSetting', json_decode($coreSetting, true));
        return $next($request);
    }
}
