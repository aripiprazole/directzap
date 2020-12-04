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
    $code = Code::query()->where('Codigo', $code)->firstOrFail();
    $user = $code->user;
    $email = $user->email;

    /** @var Configuration $config */
    $config = Configuration::query()->where('email', $email)->firstOrFail();
    $times = $config->vezes;

    /** @var Collaborator $collaborator */
    try {
      $collaborator = Collaborator::query()->where('email', $email)->findOrFail($user->next);
    } catch (Throwable $throwable) {
      $collaborator = Collaborator::query()->where('email', $email)->firstOrFail();
      $user->filled = 0;
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

    $user->filled += 1;

    if($user->filled >= $times) {
      try {
        $collaborator = Collaborator::query()->where('email', $email)->findOrFail($user->next + 1);
      } catch (Throwable $throwable) {
        $collaborator = Collaborator::query()->where('email', $email)->firstOrFail();
      }

      $user->next = $collaborator->id;
      $user->filled = 0;
    }

    $user->save();

    return $user;
  }
}
