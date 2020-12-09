<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
  /**
   * Authentication guard
   *
   * @var StatefulGuard
   */
  private $guard;

  /**
   * User service
   *
   * @var UserService
   */
  private $userService;

  /**
   * Router
   *
   * @var Router
   */
  private $router;

  /**
   * Password broker
   *
   * @var PasswordBroker
   */
  private $broker;

  public function __construct(Factory $authFactory, UserService $userService, Router $router, PasswordBroker $broker) {
    $this->guard = $authFactory->guard();
    $this->userService = $userService;
    $this->router = $router;
    $this->broker = $broker;
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function signup(Request $request) {
    $email = $request->input('email');

    if (User::query()->where('email', $email)->exists()) {
      return back()->withErrors([
        'errors' => 'Já existe uma conta com esse email.'
      ]);
    }

    $this->userService->create([
      'name' => $request->input('name'),
      'surname' => $request->input('surname'),
      'email' => $email,
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

    if ($this->guard->attempt($credentials)) {
      return redirect()->intended(route('dashboard'));
    }

    return back()->withErrors([
      'errors' => 'Credenciais inválidas'
    ]);
  }

  /**
   * @return RedirectResponse
   */
  public function logout() {
    $this->guard->logout();

    return redirect(route('login'));
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function recover(Request $request) {
    $this->broker->sendResetLink($request->only('email'));

    return redirect(route('login'))->with([
      'success' => 'Enviado com sucesso!'
    ]);
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function changePassword(Request $request) {
    $password = $request->input('password', 'password');
    $passwordConfirm = $request->input('confirm-password', 'password');
    $newPassword = $request->input('new-password', 'password');

    /** @var User $user */
    $user = $request->user();

    if ($newPassword !== $passwordConfirm) {
      return redirect(route('change-password'))->withErrors([
        'errors' => 'A senha não bate com a de confirmação'
      ]);
    }

    if ($user == null) {
      return redirect(route('change-password'))->withErrors([
        'errors' => 'Você não está logado'
      ]);
    }

    if (!Hash::check($password, $user->password)) {
      return redirect(route('change-password'))->withErrors([
        'errors' => 'Senhas não batem'
      ]);
    }

    $user->password = $newPassword;
    $user->save();

    return redirect(route('dashboard'));
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function reset(Request $request) {
    $credentials = [
      'password' => $request->input('password'),
      'email' => $request->query('email'),
      'token' => $request->query('token')
    ];

    $this->broker->reset($credentials, function (User $user, $newPassword) {
      $user->password = $newPassword;
      $user->save();
    });

    return redirect(route('login'))->with([
      'success' => 'Senha resetada com sucesso!'
    ]);
  }
}
