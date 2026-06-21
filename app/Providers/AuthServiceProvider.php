<?php

namespace App\Providers;

use App\Models\Writeup;
use App\Policies\WriteupPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Writeup::class => WriteupPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
