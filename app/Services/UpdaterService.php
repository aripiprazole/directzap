<?php


namespace App\Services;


use App\Models\SellerStatistic;
use App\Models\Code;
use App\Models\Collaborator;
use App\Models\User;
use Exception;
use Throwable;

class UpdaterService {
  public function increaseUserCountByCode(
    Code $code,
    int $times,
    int $maxCollaborators
  ): string {
    $user = $code->user;

    $collaborator = $this->findCollaborator($user->email, $user->next);

    // update collaborator routine
    if ($collaborator->counter >= $times || $collaborator->paused) {
      $collaborator = $this->findNextCollaborator($code->user, $maxCollaborators);

      $user->next = $collaborator->id;
      $collaborator->counter = 0;

      $user->save();
      $collaborator->save();
    }

    SellerStatistic::query()->create([
      'collaborator' => $collaborator,
      'total_counter' => $collaborator->counter,
      'accessed_at' => now()
    ]);

    $user->next = $collaborator->id;

    $collaborator->counter += 1;
    $collaborator->save();

    $user->save();

    return "whatsapp://send?text={$collaborator->message}&phone=+55{$collaborator->phone}";
  }

  public function findNextCollaborator(User $user, int $maxCollaborators): Collaborator {
    try {
      /** @var Collaborator $collaborator */
      $collaborator = Collaborator::query()
        ->where('email', $user->email)
        ->where('paused', '!=', 1)
        ->where('id', '>', $user->next)
        ->firstOrFail();

      $all = Collaborator::query()->where('email', $user->email)->get();

      $index = $all->search(function (Collaborator $item) use ($collaborator) {
        return $item->id == $collaborator->id;
      });

      if($index >= $maxCollaborators) {
        throw new Exception();
      }

      return $collaborator;
    } catch (Throwable $_) {
      $user->next = 0;
      $user->save();
      return $this->findNextCollaborator($user, $maxCollaborators);
    }
  }

  public function findCollaborator($email, $id) {
    /** @var Collaborator $collaborator */
    try {
      $collaborator = Collaborator::query()->where('email', $email)->findOrFail($id);
    } catch (Throwable $throwable) {
      $collaborator = Collaborator::query()->where('email', $email)->firstOrFail();
    }

    return $collaborator;
  }
}
