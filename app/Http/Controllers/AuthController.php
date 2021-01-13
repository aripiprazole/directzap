<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class AuthController extends Controller {
  /** @var StatefulGuard */
  private $guard;

  /** @var UserService */
  private $userService;

  /** @var Router */
  private $router;

  /** @var PasswordBroker */
  private $broker;

  /** @var Hasher */
  private $hasher;

  public function __construct(
    Factory $authFactory,
    UserService $userService,
    Router $router,
    PasswordBroker $broker,
    Hasher $hasher
  ) {
    $this->guard = $authFactory->guard();
    $this->userService = $userService;
    $this->router = $router;
    $this->broker = $broker;
    $this->hasher = $hasher;
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function signup(Request $request): RedirectResponse {
    $email = $request->input('email');

    if (!is_null($this->userService->findUserByEmail($email))) {
      return back()->withErrors([
        'errors' => 'Já existe uma conta com esse email.'
      ]);
    }

    $this->userService->create([
      'email' => $email,
      'name' => $request->input('name'),
      'surname' => $request->input('surname'),
      'password' => $request->input('password'),
    ]);

    return redirect(route('login'));
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function login(Request $request): RedirectResponse {
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
  public function logout(): RedirectResponse {
    $this->guard->logout();

    return redirect(route('login'));
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function recover(Request $request): RedirectResponse {
    $this->broker->sendResetLink($request->only('email'));

    return redirect(route('login'))->with([
      'success' => 'Enviado com sucesso!'
    ]);
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function changePassword(Request $request): RedirectResponse {
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

    if (!$this->hasher->check($password, $user->password)) {
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
  public function reset(Request $request): RedirectResponse {
    $password = $request->input('password');
    $confirmPassword = $request->input('confirm-password');

    if ($password !== $confirmPassword) {
      return back()->withErrors([
        'errors' => 'As senhas não batem'
      ]);
    }

    $credentials = [
      'password' => $password,
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
