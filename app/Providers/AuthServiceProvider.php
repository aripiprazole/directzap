<?php

namespace App\Providers;

use App\Auth\JwtGuard;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider {
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   * @throws BindingResolutionException
   */
  public function boot() {
    $this->registerPolicies();

    $jwtGuard = new JwtGuard(
      $this->app->make(Hasher::class),
      $this->app->make(Session::class)
    );

    Auth::extend('jwt', function () use ($jwtGuard) {
      return $jwtGuard;
    });
  }
}
