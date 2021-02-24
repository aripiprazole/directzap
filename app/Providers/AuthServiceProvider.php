<?php

namespace App\Providers;

use App\Collaborator;
use App\Configuration;
use App\Policies\CollaboratorPolicy;
use App\Policies\ConfigurationPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    Collaborator::class => CollaboratorPolicy::class,
    User::class => UserPolicy::class,
    Configuration::class => ConfigurationPolicy::class
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot() {
    $this->registerPolicies();
  }
}
