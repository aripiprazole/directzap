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

  private $uniqueKey;

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

    Mail::to($request->input(self::EMAIL))
      ->send(new ActivationMail(Activation::query()->create([
        'code' => Activation::code(),
        'is_activated' => false
      ])));

    return response();
  }

  public function chargeback(Request $request) {
    if ($request->input(self::UNIQUE_KEY) != $this->uniqueKey) {
      return response()->setStatusCode(400);
    }

    $email = $request->input(self::EMAIL);

    Activation::query()->where('email', $email)
      ->update([
        'is_activated' => false
      ]);

    return response();
  }

}
