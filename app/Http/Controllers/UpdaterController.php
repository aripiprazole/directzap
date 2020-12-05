<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Collaborator;
use App\Models\Configuration;
use App\Models\SellerStatistic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class UpdaterController extends Controller {
  /**
   * @param string $name
   * @param Request $request
   * @return RedirectResponse|null|string
   */
  public function increase(string $name, Request $request) {
    $code = $request->query('cod');

    /** @var Code $code */
    $code = Code::query()->where('Codigo', $code)->first();

    if($code === null) {
      return 'Configuração do usuário não finalizada.';
    }

    $user = $code->user;
    $email = $user->email;

    /** @var Configuration $config */
    $config = Configuration::query()->where('email', $email)->first();

    if($config === null) {
      return 'Configuração do usuário não finalizada.';
    }

    $times = $config->vezes;

    $collaborator = $this->getNextCollaborator($user->email, $user->next);

    // update collaborator routine
    if ($collaborator->counter >= $times || $collaborator->paused) {
      $collaborator = $this->getNextCollaborator($user->email, $user->next + 1);

      $user->next = $collaborator->id;
      $collaborator->counter = 0;

      $user->save();
      $collaborator->save();
    }

    $user->next = $collaborator->id;

    $collaborator->counter += 1;
    $collaborator->save();

    // save statistic
    SellerStatistic::query()->create([
      'collaborator' => $collaborator,
      'total_counter' => $collaborator->counter,
      'accessed_at' => now()
    ]);

    $user->save();

    return view('redirect', [
      'link' => $collaborator->link
    ]);
  }

  private function getNextCollaborator(string $email, $id): Collaborator {
    /** @var Collaborator $collaborator */
    try {
      $collaborator = Collaborator::query()->where('email', $email)->findOrFail($id);
    } catch (Throwable $throwable) {
      $collaborator = Collaborator::query()->where('email', $email)->firstOrFail();
    }

    return $collaborator;
  }
}
