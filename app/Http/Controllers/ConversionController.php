<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConversionController extends Controller {
  public function __invoke(Request $request) {
    $code = $request->query('cod');

    if (is_null($code)) {
      return view('content.home');
    }

    // todo
  }
}
