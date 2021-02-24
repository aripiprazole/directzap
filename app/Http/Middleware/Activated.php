<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;

class Activated {
  protected $redirectTo = "/dashboard/activate";

  /**
   * Handle an incoming request.
   *
   * @param Request $request
   * @param Closure $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next) {
    /** @var User $user */
    $user = $request->user();

    if (is_null($user)) {
      return redirect($this->redirectTo);
    }

    return $next($request);
  }
}
