<?php

namespace App\Http\Controllers;

use App\Services\ConfigService;
use App\Services\PixelService;
use App\Services\UpdaterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UpdaterController extends Controller {
  /**
   * @var ConfigService
   */
  private $configService;

  /**
   * @var UpdaterService
   */
  private $updaterService;

  /**
   * @var PixelService
   */
  private $pixelService;

  public function __construct(
    ConfigService $configService,
    UpdaterService $updaterService,
    PixelService $pixelService
  ) {
    $this->configService = $configService;
    $this->updaterService = $updaterService;
    $this->pixelService = $pixelService;
  }

  /**
   * @param string $name
   * @param Request $request
   * @return Application|ResponseFactory|RedirectResponse|Response
   */
  public function increase(string $name, Request $request) {
    $code = $this->configService->findCodeByCodeString($request->query('cod'));
    if ($code === null) {
      return response('Configuração do usuário não finalizada.');
    }

    $user = $code->user;
    $email = $user->email;

    if(!$user->is_activated) {
      return response('Painel não está ativado');
    }

    $config = $this->configService->findUserTimesByEmail($email);
    if ($config === null) {
      return response('Configuração do usuário não finalizada.');
    }

    $pixel = $this->pixelService->findPixelByFullName($name);
    if ($pixel == null) {
      return response('Configuração do usuário não finalizada.');
    }

    return view('redirect', [
      'link' => $this->updaterService->increaseUserCountByCode(
        $code,
        $config,
        $this->configService->findMaxCollaboratorsByEmail($email)
      ),
      'pixel' => $pixel
    ]);
  }
}
