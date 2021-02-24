<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeUpdateRequest;
use App\User;
use Illuminate\Http\RedirectResponse;

class MeController extends Controller {
  public function update(MeUpdateRequest $request): RedirectResponse {
    /** @var User $user */
    $user = $request->user();

    $user->update($request->only([
      'name', 'surname', 'email'
    ]));

    return back()
      ->with('message', __('locale.Successfully updated me'));
  }
}
