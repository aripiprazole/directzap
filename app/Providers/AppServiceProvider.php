<?php

namespace App\Providers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {
    $this->app->singleton(UserService::class);

    ResetPassword::toMailUsing(function (User $user, string $token) {
      $count = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');
      $url = url(route('password.reset', [
        'token' => $token,
        'email' => $user->getEmailForPasswordReset(),
      ], false));

      return (new MailMessage)
        ->markdown('notifications.password-reset', compact('user', 'url'));
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    //
  }
}
