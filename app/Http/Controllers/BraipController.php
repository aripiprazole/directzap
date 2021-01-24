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
  private const EMAIL = 'client_email';
  private const PRODUCT_KEY = 'product_key';
  private const PLAN_KEY = 'plan_key';
  private const SUBS_KEY = 'subs_key';
  private const SUBS_CODE = 'subs_code';

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
      return response()->setStatusCode(400);
    }

    if ($request->input(self::SUBS_CODE) != 'Ativa') {
      return \response()->setStatusCode(400);
    }

    Mail::to($request->input(self::EMAIL))->send(
      new ActivationMail(
        Activation::query()->create([
          'code' => $request->input(self::SUBS_KEY),
          'is_activated' => false
        ])
      )
    );

    return response();
  }

  public function chargeback(Request $request) {
    if ($request->input(self::UNIQUE_KEY) != $this->uniqueKey) {
      return response()->setStatusCode(400);
    }

    $code = $request->input(self::SUBS_KEY);

    Activation::query()
      ->where('code', $code)
      ->update(['is_activated' => false]);

    return response();
  }

}
