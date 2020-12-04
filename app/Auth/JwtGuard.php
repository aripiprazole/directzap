<?php

namespace App\Auth;

use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Throwable;

class JwtGuard implements StatefulGuard {
  private const JWT_TOKEN_KEY = 'JWT_TOKEN';

  /**
   * Logged user
   *
   * @var User
   */
  private $user;

  /**
   * Password hasher
   *
   * @var Hasher
   */
  private $hasher;

  /**
   * Current session
   *
   * @var Session
   */
  private $session;

  /**
   * JWT secret
   *
   * @var string
   */
  private $secret;

  /**
   * JWT algo
   *
   * @var string
   */
  private $algo;

  public function __construct(Hasher $hasher, Session $session) {
    $this->hasher = $hasher;
    $this->session = $session;
    $this->secret = config('auth.secret');
    $this->algo = config('auth.algo');
  }

  /**
   * Determine if the current user is authenticated.
   *
   * @return bool
   */
  public function check(): bool {
    return $this->user() !== null;
  }

  /**
   * Determine if the current user is a guest.
   *
   * @return bool
   */
  public function guest(): bool {
    return $this->user() === null;
  }

  /**
   * Get the currently authenticated user.
   *
   * @return Authenticatable|null
   */
  public function user(): ?Authenticatable {
    if ($this->user != null)
      return $this->user;

    try {
      if (filled($bearerToken = $this->session->get(self::JWT_TOKEN_KEY))) {
        $userId = $this->validatePayloadAndGetId($this->decodePayload($bearerToken));
        $this->user = User::query()->findOrFail($userId);

        return $this->user;
      }
    } catch (Throwable $_) {
      throw $_;
    }

    return null;
  }

  /**
   * Get the ID for the currently authenticated user.
   *
   * @return int|string|null
   */
  public function id(): int {
    return optional($this->user())->id ?: -1;
  }

  /**
   * Validate a user's credentials.
   *
   * @param array $credentials
   * @return array
   * @throws ValidationException
   */
  public function validate(array $credentials = []): array {
    $validator = Validator::make($credentials, [
      'email' => 'required|string',
      'password' => 'required|string',
    ]);

    return $validator->validated();
  }

  /**
   * Set the current user.
   *
   * @param Authenticatable $user
   * @return void
   */
  public function setUser(Authenticatable $user) {
    $this->user = $user;
  }

  /**
   * Attempt to authenticate a user using the given credentials.
   *
   * @param array $credentials
   * @param bool $remember
   * @return bool
   * @throws ValidationException
   */
  public function attempt(array $credentials = [], $remember = false): bool {
    $credentials = $this->validate($credentials);
    $email = $credentials['email'];
    $password = $credentials['password'];

    /** @var User $user */
    $user = User::query()->where('email', $email)->firstOrFail();

    if ($this->hasher->check($password, $user->password)) {
      $this->login($user);

      return true;
    }

    return false;
  }

  /**
   * Log a user into the application without sessions or cookies.
   *
   * @param array $credentials
   * @return bool
   * @throws ValidationException
   */
  public function once(array $credentials = []) {
    return $this->attempt($credentials);
  }

  /**
   * Log a user into the application.
   *
   * @param Authenticatable $user
   * @param bool $remember
   * @return void
   */
  public function login(Authenticatable $user, $remember = false) {
    $this->setUser($user);
    $this->session->put(self::JWT_TOKEN_KEY, $this->generateToken($user));
  }

  /**
   * Log the given user ID into the application.
   *
   * @param mixed $id
   * @param bool $remember
   * @return Authenticatable|bool
   */
  public function loginUsingId($id, $remember = false): Authenticatable {
    /** @var User $user */
    $user = User::query()->findOrFail($id);
    $this->login($user);
    return $user;
  }

  /**
   * Log the given user ID into the application without sessions or cookies.
   *
   * @param mixed $id
   * @return Authenticatable|bool
   */
  public function onceUsingId($id): Authenticatable {
    return $this->loginUsingId($id);
  }

  /**
   * Determine if the user was authenticated via "remember me" cookie.
   *
   * @return bool
   * @throws Exception
   */
  public function viaRemember(): bool {
    throw new Exception("NOT IMPLEMENTED");
  }

  /**
   * Log the user out of the application.
   *
   * @return void
   */
  public function logout(): void {
    $this->session->remove(self::JWT_TOKEN_KEY);
  }

  /**
   * @param array $payload
   * @return int
   * @throws ValidationException
   */
  private function validatePayloadAndGetId(array $payload): int {
    $validator = Validator::make($payload, [
      'id' => 'required|numeric'
    ]);

    return $validator->validated()['id'];
  }

  private function decodePayload(string $token): array {
    return (array)JWT::decode($token, $this->secret, [$this->algo]);
  }

  private function generateToken(User $user): string {
    $payload = ['id' => $user->id];
    return JWT::encode($payload, $this->secret, $this->algo);
  }
}
