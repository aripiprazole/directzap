<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConfigurationController extends Controller {
  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request) {
    $times = intval($request->input('times'));

    /** @var User $user */
    $user = $request->user();

    if (0 > $times) {
      return redirect(route('dashboard'))->withErrors('Times cannot be less than 0');
    }

    /** @var Configuration $configuration */
    if (filled($configuration = Configuration::query()->where('email', $user->email)->first())) {
      $configuration->vezes = $times;
      $configuration->save();

      return redirect(route('dashboard'));
    }

    Configuration::query()->create([
      'vezes' => $times,
      'user' => $user
    ]);

    return redirect(route('dashboard'));
  }
}
