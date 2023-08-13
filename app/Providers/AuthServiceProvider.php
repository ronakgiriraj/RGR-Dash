<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Sections;
use Illuminate\Support\Facades\Cache;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $minutes = 60 * 60; // 1 hour
        $sections = Cache::remember('sections', $minutes, function () {
            return Sections::all();
        });

        $scopes = [];
        foreach ($sections as $section) {
            $scopes[$section->name] = $section->caption;
            Gate::define($section->name, function ($user) use ($section) {
                return $user->hasPermission($section->name);
            });
        }
    }
}
