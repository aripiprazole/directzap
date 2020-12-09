<?php

namespace App\Services;

use App\Models\User;

class UserService {
  public function findUserById(int $id): User {
    /** @var User $user */
    $user = User::query()->findOrFail($id);

    return $user;
  }

  public function findUserByEmail(string $email): User {
    /** @var User $user */
    $user = User::query()->where('email', $email)->firstOrFail();

    return $user;
  }

  public function create(array $data): User {
    /** @var User $user */
    $user = User::query()->create($data);

    return $user;
  }
}
