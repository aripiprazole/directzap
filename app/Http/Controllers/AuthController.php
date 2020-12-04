<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller {
  /**
   * Authentication guard
   *
   * @var StatefulGuard
   */
  private $guard;

  public function __construct(Factory $authFactory) {
    $this->guard = $authFactory->guard();
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function signup(Request $request) {
    User::query()->create([
      'name' => $request->input('name'),
      'surname' => $request->input('surname'),
      'email' => $request->input('email'),
      'password' => $request->input('password'),
    ]);

    return redirect(route('login'));
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function login(Request $request) {
    $credentials = $request->only('email', 'password');

    if($this->guard->attempt($credentials)) {
      return redirect()->intended(route('dashboard'));
    }

    return back()->withErrors('Invalid credentials');
  }

  /**
   * @return RedirectResponse
   */
  public function logout() {
    $this->guard->logout();

    return redirect(route('login'));
  }
}
