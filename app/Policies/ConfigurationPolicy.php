<?php

namespace App\Policies;

use App\Configuration;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy {
  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param User $user
   * @return mixed
   */
  public function viewAny(User $user) {
    return $user->hasRole('Administrator');
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param User $user
   * @param Configuration $configuration
   * @return mixed
   */
  public function view(User $user, Configuration $configuration) {
    return $user->hasRole('Administrator') || $user->id === $configuration->user->id
      ? $this->allow()
      : $this->deny("You do not own the configuration {$configuration->id}.");
  }

  /**
   * Determine whether the user can create models.
   *
   * @param User $user
   * @return mixed
   */
  public function create(User $user) {
    return $this->deny();
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param User $user
   * @param Configuration $configuration
   * @return mixed
   */
  public function update(User $user, Configuration $configuration) {
    return $user->hasRole('Administrator') || $user->id === $configuration->user->id
      ? $this->allow()
      : $this->deny("You do not own the configuration {$configuration->id}.");
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param User $user
   * @param Configuration $configuration
   * @return mixed
   */
  public function delete(User $user, Configuration $configuration) {
    return $this->deny();
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param User $user
   * @param Configuration $configuration
   * @return mixed
   */
  public function restore(User $user, Configuration $configuration) {
    return $this->deny();
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param User $user
   * @param Configuration $configuration
   * @return mixed
   */
  public function forceDelete(User $user, Configuration $configuration) {
    return $this->deny();
  }
}
