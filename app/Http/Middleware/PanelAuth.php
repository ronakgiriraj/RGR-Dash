<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PanelAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected $except = [
        '/panel/login/check',
        '/panel/login'
    ];

    protected function inExceptArray($request){
        foreach($this->except as $except){
            if($except !== '/'){
                $except = trim($except, '/');
            }
            if($request->is($except)){
                return true;
            }
        }

        return false;
    }

    public function handle(Request $request, Closure $next)
    {
        if($this->inExceptArray($request)){
            return $next($request);
        }

        if(auth()->check()){
            $user = auth()->user();

            view()->share('authUser', $user);

            if($user->isAdmin()){
                return redirect('/admin');

            }else{
                return $next($request);
            }

        }else{
            return redirect('/panel/login');
        }
    }
}
