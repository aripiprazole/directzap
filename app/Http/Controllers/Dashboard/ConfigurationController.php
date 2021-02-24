<?php

namespace App\Http\Controllers\Dashboard;

use App\Configuration;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationUpdateRequest;
use Illuminate\Http\RedirectResponse;

class ConfigurationController extends Controller {
  public function update(ConfigurationUpdateRequest $request, Configuration $configuration): RedirectResponse {
    $configuration->update([
      'max_collaborators' => $request->input('max-collaborators'),
      'code' => $request->input('code'),
      'conv_per_user' => $request->input('conv-per-user')
    ]);

    return back()->with('message', __('locale.Successfully updated configuration'));
  }
}
