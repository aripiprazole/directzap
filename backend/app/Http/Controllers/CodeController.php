<?php

namespace App\Http\Controllers;

use App\Services\ConfigService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CodeController extends Controller {
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
    $string = $request->input('code');

    if (strlen($string) > 5) {
      return redirect(route('dashboard'))->withErrors([
        'errors' => 'O seu código deve ter no máximo 5 caractéres.'
      ]);
    }

    if (!is_null($this->configService->findCodeByCodeString($string))) {
      return redirect(route('dashboard'))->withErrors([
        'errors' => 'Esse código já foi registrado.'
      ]);
    }

    $this->configService->setUserCode($request->user(), $string);

    return redirect(route('dashboard'));
  }
}
