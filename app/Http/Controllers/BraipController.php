<?php


namespace App\Http\Controllers;

use App\Mail\ActivationMail;
use App\Models\Activation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class BraipController {
  private const UNIQUE_KEY = 'basic_authentication';
  private const PRODUCT_KEY = 'product_key';
  private const PLAN_KEY = 'plan_key';
  private $uniqueKey = '';

  public function __construct() {
    $this->uniqueKey = config('app.unique_key');
  }

  /**
   * @param Request $request
   * @return Application|ResponseFactory|Response|object
   */
  public function selled(Request $request) {
    if ($request->input(self::UNIQUE_KEY) != $this->uniqueKey) {
      return response('unique key do not match');
    }

    if($request->input('trans_status_code') !== 2) {
      return \response('your code is not approved');
    }

    $activation = Activation::query()->create([
      'code' => $request->input('trans_key'),
      'is_activated' => false
    ]);

    Mail::to($request->input('client_email'))->send(new ActivationMail($activation));

    return response()->noContent();
  }

  public function chargeback(Request $request) {
    if ($request->input(self::UNIQUE_KEY) != $this->uniqueKey) {
      return response()->setStatusCode(400);
    }

    $code = $request->input('trans_key');

    Activation::query()
      ->where('code', $code)
      ->update(['is_activated' => false]);

    return response()->noContent();
  }

}
