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
      $url = url(route('password.reset', [
        'token' => $token,
        'email' => $user->getEmailForPasswordReset(),
      ], false));

      return (new MailMessage)
        ->subject('Recuperação de senha')
        ->view('notifications.password-reset', [
          'user' => $user,
          'url' => $url
        ]);
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
