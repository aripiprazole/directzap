<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CodeController extends Controller {
  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request) {
    $string = $request->input('code');

    if (strlen($string) > 5) {
      return redirect(route('dashboard'))->withErrors([
        'errors' => 'O seu código deve ter no máximo 5 caractéres.'
      ]);
    }

    if (Code::query()->where('Codigo', $string)->exists()) {
      return redirect(route('dashboard'))->withErrors([
        'errors' => 'Esse código já foi registrado.'
      ]);
    }

    Code::query()->create([
      'code' => $string,
      'user' => $request->user()
    ]);

    return redirect(route('dashboard'));
  }
}
