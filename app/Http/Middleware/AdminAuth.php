<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class AdminAuth
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     protected function except(){
        return $except = [
            '/'. getAdminUrl() .'/login/check',
            '/'. getAdminUrl() .'/login',
        ];
    }

    protected function inExceptArray($request)
    {
        foreach ($this->except() as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->inExceptArray($request)) {
            return $next($request);
        }

        if (auth()->check()) {
            $user = auth()->user();
            view()->share('authUser', $user);

            \Session::forget('impersonated');

            // $sidebarController = new SidebarController();

            // $sidebarBeeps = [];
            // $sidebarBeeps['onlineLead'] = $sidebarController->getOnlineLead();
            // $sidebarBeeps['onlineRequest'] = $sidebarController->getOnlineRequest();
            // $sidebarBeeps['lead'] = $sidebarController->getAnyLead();
            // $sidebarBeeps['subscriberTicket'] = $sidebarController->getSubscriberTicket();

            // view()->share('sidebarBeeps', $sidebarBeeps);

            if(!empty($user) && $user->status !== User::$active){
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/');
            }

            if(auth()->user()->isAdmin()){
                return $next($request);
            }else{
                return redirect('panel');
            }
        }else{
            return redirect('/'. getAdminUrl() .'/login');
        }
    }
}
