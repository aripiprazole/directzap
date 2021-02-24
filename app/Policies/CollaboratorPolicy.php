<?php

namespace App\Policies;

use App\Collaborator;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollaboratorPolicy {
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
   * @param Collaborator $collaborator
   * @return mixed
   */
  public function view(User $user, Collaborator $collaborator) {
    return $collaborator->user->id === $user->id
      ? $this->allow()
      : $this->deny("You do not own the collaborator {$collaborator->id}.");
  }

  /**
   * Determine whether the user can create models.
   *
   * @param User $user
   * @return mixed
   */
  public function create(User $user) {
    return $user->active;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param User $user
   * @param Collaborator $collaborator
   * @return mixed
   */
  public function update(User $user, Collaborator $collaborator) {
    return $collaborator->user->id === $user->id
      ? $this->allow()
      : $this->deny("You do not own the collaborator {$collaborator->id}.");
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param User $user
   * @param Collaborator $collaborator
   * @return mixed
   */
  public function delete(User $user, Collaborator $collaborator) {
    return $collaborator->user->id === $user->id
      ? $this->allow()
      : $this->deny("You do not own the collaborator {$collaborator->id}.");
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param User $user
   * @param Collaborator $collaborator
   * @return mixed
   */
  public function restore(User $user, Collaborator $collaborator) {
    return $collaborator->user->id === $user->id
      ? $this->allow()
      : $this->deny("You do not own the collaborator {$collaborator->id}.");
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param User $user
   * @param Collaborator $collaborator
   * @return mixed
   */
  public function forceDelete(User $user, Collaborator $collaborator) {
    return $collaborator->user->id === $user->id
      ? $this->allow()
      : $this->deny("You do not own the collaborator {$collaborator->id}.");
  }
}
