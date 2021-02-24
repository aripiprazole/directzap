<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationUpdateRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class MeConfigurationController extends Controller {
  public function refresh(Request $request): RedirectResponse {
    /** @var User $user */
    $user = $request->user();

    $user->configuration()->update([
      'code' => Uuid::uuid6()
    ]);

    return back()->with('message', __('locale.Successfully updated me'));
  }

  public function update(ConfigurationUpdateRequest $request): RedirectResponse {
    /** @var User $user */
    $user = $request->user();

    $user->configuration()->update([
      'conv_per_user' => $request->input('conv-per-user'),
      'pix' => empty($request->input('pix'))
        ? null
        : $request->input('pix')
    ]);

    return back()->with('message', __('locale.Successfully updated me'));
  }
}
