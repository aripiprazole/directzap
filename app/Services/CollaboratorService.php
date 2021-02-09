<?php


namespace App\Services;


use App\Models\Collaborator;

class CollaboratorService {

  public function findCollaboratorById($id): Collaborator {
    /** @var Collaborator $collaborator */
    $collaborator = Collaborator::query()->findOrFail($id);

    return $collaborator;
  }

  public function createCollaborator($data): Collaborator {
    /** @var Collaborator $collaborator */
    $collaborator = Collaborator::query()->create($data);

    return $collaborator;
  }
}
