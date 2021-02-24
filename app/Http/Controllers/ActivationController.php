<?php

namespace App\Http\Controllers;

use App\Activation;
use App\Http\Requests\ActivateRequest;
use App\Http\Requests\MeActivateRequest;
use App\Mail\ActivationEmail;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class ActivationController extends Controller {
  private $uniqueKey;

  public function __construct() {
    $this->uniqueKey = config('app.braip.unique_key');
  }

  public function self(MeActivateRequest $request): RedirectResponse {
    /** @var User $user */
    $user = $request->user();
    $activation = Activation::findByCode($request->input('code'));

    if (is_null($activation) || $activation->used || !is_null($activation->user)) {
      return back()->with('error', __('locale.Invalid activation code'));
    }

    $activation->used = true;
    $user->activations()->save($activation);

    return back()->with('message', __('locale.Successfully activated self'));
  }

  public function manual(ActivateRequest $request): RedirectResponse {
    /** @var User $user */
    $user = User::query()->findOrFail($request->input('user_id'));

    $user->activations()->create([
      'code' => Uuid::uuid6(),
      'used' => true,
    ]);

    return back()->with('message', __('locale.Successfully activated user'));
  }

  public function webhook(Request $request): Response {
    if ($request->input('basic_authentication') != $this->uniqueKey) {
      return response("Unique key doesn't match!");
    }

    if ($request->input('trans_status_code') !== 2) {
      if ($request->input('basic_authentication') != $this->uniqueKey) {
        return response()->setStatusCode(400);
      }

      $code = $request->input('trans_key');

      Activation::query()
        ->where('code', $code)
        ->update([
          'used' => false,
          'expired' => true
        ]);

      return response()->noContent();
    }

    $activation = Activation::query()->create([
      'code' => $request->input('trans_key'),
      'type' => 'automatic',
      'used' => false
    ]);

    Mail::to($request->input('client_email'))->send(new ActivationEmail($activation));

    return response()->noContent();
  }
}
