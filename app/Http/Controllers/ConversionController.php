<?php

namespace App\Http\Controllers;

use App\Collaborator;
use App\Configuration;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class ConversionController extends Controller {
  public function __invoke(Request $request) {
    $code = $request->query('cod');

    if (is_null($code)) {
      return view('content.home');
    }

    $configuration = Configuration::findByCode($code);
    $convPerUser = $configuration->conv_per_user;
    $maxCollaborators = $configuration->max_collaborators;
    $user = $configuration->user;

    /** @var Collaborator|null $collaborator */
    $collaborator =
      $user->collaborators()->find($user->next) ??
      $user->collaborators()->first();

    if (is_null($collaborator)) {
      return "";
    }

    // update collaborator routine
    if ($collaborator->fill_count >= $convPerUser || !$collaborator->active) {
      $collaborator = $this->findNextCollaborator($user, $maxCollaborators);

      $user->next = $collaborator->id;
      $collaborator->fill_count = 0;

      $user->save();
      $collaborator->save();
    }

    $user->next = $collaborator->id;

    $collaborator->fill_count += 1;
    $collaborator->total_count += 1;

    $collaborator->save();

    $user->save();

    return view('content.conversion', [
      'link' => "whatsapp://send?text={$collaborator->message}&phone=+55{$collaborator->phone}"
    ]);
  }

  private function findNextCollaborator(User $user, $maxCollaborators): ?Collaborator {
    try {
      /** @var Collaborator $collaborator */
      $collaborator = $user->collaborators()
        ->where('status', Collaborator::ACTIVE)
        ->where('id', '>', $user->next)
        ->first();

      $all = Collaborator::query()->where('email', $user->email)->get();

      $index = $all->search(function (Collaborator $item) use ($collaborator) {
        return $item->id == $collaborator->id;
      });

      if ($index >= $maxCollaborators) {
        throw new Exception();
      }

      return $collaborator;
    } catch (Throwable $ignored) {
      $user->next = 0;
      $user->save();

      return $this->findNextCollaborator($user, $maxCollaborators);
    }
  }
}
