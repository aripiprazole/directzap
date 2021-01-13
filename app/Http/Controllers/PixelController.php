<?php

namespace App\Http\Controllers;

use App\Services\PixelService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PixelController extends Controller {
  /** @var PixelService */
  private $pixelService;

  /**
   * @param string $name
   * @return string
   */
  public function show(string $name): string {
    return $this->pixelService->findPixelByFullName($name);
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request): RedirectResponse {
    $this->pixelService->createPixel($request->user(), $request->input('pixel'));

    return redirect(route('dashboard'));
  }
}
