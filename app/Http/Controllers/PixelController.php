<?php

namespace App\Http\Controllers;

use App\Models\Pixel;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PixelController extends Controller {
  /**
   * @param string $name
   * @return string
   */
  public function show(string $name) {
    $email = User::query()->where(DB::raw('CONCAT(nome, Sobrenome)'), 'LIKE', $name)->firstOrFail()->email;

    return Pixel::query()->where('Email', $email)->firstOrFail()->Pixel;
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request): RedirectResponse {
    $string = $request->input('pixel');
    if (filled($pixel = Pixel::query()->where('Pixel', $string)->first())) {
      $pixel->update([
        'code' => $string
      ]);
    } else {
      Pixel::query()->create([
        'code' => $string,
        'user' => $request->user()
      ]);
    }

    return redirect(route('dashboard'));
  }
}
