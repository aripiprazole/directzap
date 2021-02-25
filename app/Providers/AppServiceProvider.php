<?php

namespace App\Providers;

use App\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;


class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    Schema::defaultStringLength(191);
    Passport::routes();
    ResetPassword::toMailUsing(function (User $user, $token) {
      return view('mail.reset-password', [
        'name' => $user->name,
        'url' => url(route('password.reset', [
          'token' => $token,
          'email' => $user->getEmailForPasswordReset(),
        ], false))
      ]);
    });
  }
}
