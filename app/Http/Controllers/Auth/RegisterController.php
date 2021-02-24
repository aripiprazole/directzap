<?php

namespace App\Http\Controllers\Auth;

use App\Configuration;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller {
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = '/dashboard';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('guest');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data): \Illuminate\Contracts\Validation\Validator {
    return Validator::make($data, [
      'name' => ['required', 'string', 'max:190'],
      'email' => ['required', 'string', 'email', 'max:190', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param array $data
   * @return User
   */
  protected function create(array $data): User {
    /** @var User $user */
    $user = User::query()->create([
      'name' => $data['name'],
      'surname' => $data['surname'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);

    $configuration = new Configuration([
      'code' => Uuid::uuid6()
    ]);

    // setup configuration
    $user->configuration()->save($configuration);

    return $user;
  }

  // Register
  public function showRegistrationForm() {
    $pageConfigs = [
      'bodyClass' => "bg-full-screen-image",
      'blankPage' => true
    ];

    return view('auth.register', [
      'pageConfigs' => $pageConfigs
    ]);
  }
}
