<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeUpdateRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MeController extends Controller {
  private $storage;

  public function __construct(FilesystemManager $filesystem) {
    $this->storage = $filesystem->disk($filesystem->getDefaultDriver());
  }

  public function update(MeUpdateRequest $request): RedirectResponse {
    /** @var User $user */
    $user = $request->user();

    $avatar = $request->file('avatar');

    if(!is_null($avatar)) {
      $this->storage->put("avatars/{$user->id}", $avatar->get());
    }

    $user->update($request->only([
      'name', 'surname', 'email'
    ]));

    return back()->with('message', __('locale.Successfully updated me'));
  }

  public function avatar(Request $request): BinaryFileResponse {
    /** @var User $user */
    $user = $request->user();
    $location = "avatars/{$user->id}";

    if (!$this->storage->exists($location)) {
      $location = 'avatars/default.png';
    }

    return response()->file(storage_path("app/$location"));
  }

  public function updateAvatar(Request $request): RedirectResponse {
    $this->storage->put("avatars/{$request->user()->id}", $request->file('avatar'));

    return back()->with('message', __('locale.Successfully updated me'));
  }

  public function updatePassword(UpdatePasswordRequest $request): RedirectResponse {
    /** @var User $user */
    $user = $request->user();

    if (!Hash::check($request->input('password'), $user->password)) {
      return back()->with('error', __('passwords.invalid'));
    }

    $user->update([
      'password' => Hash::make($request->input('new-password'))
    ]);

    return back()->with('message', __('locale.Successfully updated me'));
  }
}
