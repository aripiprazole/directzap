<?php

namespace App\Providers;

use App\Auth\JwtGuard;
use App\Models\Collaborator;
use App\Policies\CollaboratorPolicy;
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
  protected $policies = [Collaborator::class => CollaboratorPolicy::class];

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
