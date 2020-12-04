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
    $code = $request->input('code');

    if (strlen($code) > 5) {
      return redirect(route('dashboard'));
    }

    Code::query()->create([
      'code' => $code,
      'user' => $request->user()
    ]);

    return redirect(route('dashboard'));
  }
}
