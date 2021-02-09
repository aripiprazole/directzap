<?php

namespace App\Policies;

use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CollaboratorPolicy {
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   *
   * @return void
   */
  public function __construct() {
    //
  }
  /**
   * Determine whether the user can create collaborators.
   *
   * @param User $user
   * @return mixed
   */
  public function create(User $user) {
    return $this->isActivated($user);
  }

  /**
   * Determine whether the user can update a collaborator.
   *
   * @param User $user
   * @param Collaborator $collaborator
   * @return mixed
   */
  public function delete(User $user, Collaborator $collaborator) {
    if ($user->email !== $collaborator->email)
      return Response::deny("Você não é dono desse colaborator: {$collaborator->name}.");

    return $this->isActivated($user);
  }

  /**
   * Determine whether the user can delete a collaborator.
   *
   * @param User $user
   * @param Collaborator $collaborator
   * @return mixed
   */
  public function update(User $user, Collaborator $collaborator) {
    if ($user->email !== $collaborator->email)
      return Response::deny("Você não é dono desse colaborator: {$collaborator->name}.");

    return $this->isActivated($user);
  }


  private function isActivated(User $user) {
    if (!$user->is_activated)
      return Response::deny("Você ainda não foi ativado.");

    return Response::allow();
  }
}
