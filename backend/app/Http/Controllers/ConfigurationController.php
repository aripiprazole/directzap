<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ConfigService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConfigurationController extends Controller {
  /** @var ConfigService */
  private $configService;

  public function __construct(ConfigService $configService) {
    $this->configService = $configService;
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request): RedirectResponse {
    $times = intval($request->input('times'));

    /** @var User $user */
    $user = $request->user();

    if (0 > $times) {
      return redirect(route('dashboard'))->withErrors([
        'errors' => 'As vezes não podem ser menores que 0.'
      ]);
    }

    $this->configService->setUserTimes($user, $times);

    return redirect(route('dashboard'));
  }
}
