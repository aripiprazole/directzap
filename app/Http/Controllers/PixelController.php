<?php

namespace App\Http\Controllers;

use App\Models\Pixel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PixelController extends Controller {
  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request) {
    Pixel::query()->create([
      'code' => $request->input('pixel'),
      'user' => $request->user()
    ]);

    return redirect(route('dashboard'));
  }
}
