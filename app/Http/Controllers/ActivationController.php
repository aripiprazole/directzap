<?php


namespace App\Http\Controllers;

use App\Models\Activation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivationController extends Controller {
  public function activateSelf(Request $request): ?RedirectResponse {
    $code = Activation::query()->where('code', $request->input('code'))->first();
    if($code == null) {
      return back()->withErrors([
        'errors' => 'Código não encontrado!'
      ]);
    }

    if($code->is_activated) {
      return back()->withErrors([
        'errors' => 'Código já usado!'
      ]);
    }

    if($code->email != null) {
      return back()->withErrors([
        'errors' => 'Código já usado!'
      ]);
    }

    $code->is_activated = true;
    $code->email = $request->user()->email;
    $code->save();

    return back();
  }

  public function activate(Request $request): ?RedirectResponse {
    if(!$request->user()->isAdministrator()) {
      return back()->withErrors([
        'errors' => 'Voce nao é administrador'
      ]);
    }

    Activation::query()->create([
      'email' => $request->input('email'),
      'code' => Activation::code(),
      'is_activated' => true
    ]);

    return back();
  }
}
