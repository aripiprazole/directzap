<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller {
  private $storage;

  public function __construct(FilesystemManager $filesystem) {
    $this->storage = $filesystem->disk($filesystem->getDefaultDriver());
  }

  public function index(Request $request) {
    $breadcrumbs = [
      ['link' => "dashboard", 'name' => __('pages.Dashboard')], ['name' => __('pages.Users')]
    ];

    return view('content.dashboard.users', [
      'breadcrumbs' => $breadcrumbs,
      'user' => $request->user(),
      'users' => User::query()->paginate(15)
    ]);
  }

  public function avatar(User $user): BinaryFileResponse {
    $location = "avatars/{$user->id}";

    if (!$this->storage->exists($location)) {
      $location = 'avatars/default.png';
    }

    return response()->file(storage_path("app/$location"));
  }

  public function edit(Request $request, User $user) {
    $breadcrumbs = [
      ['link' => "dashboard", 'name' => __('pages.Dashboard')],
      ['link' => "dashboard/users", 'name' => __('pages.Users')],
      ['name' => __('pages.Edit user')]
    ];

    return view('content.dashboard.users.edit', [
      'breadcrumbs' => $breadcrumbs,
      'user' => $request->user(),
      'target' => $user
    ]);
  }

  /**
   * @param UserUpdateRequest $request
   * @param User $user
   * @return RedirectResponse
   * @throws FileNotFoundException
   */
  public function update(UserUpdateRequest $request, User $user): RedirectResponse {
    if(!is_null($avatar = $request->file('avatar'))) {
      $this->storage->put("avatars/{$user->id}", $avatar->get());
    }

    if(!empty($password = $request->input('password'))) {
      $user->password = Hash::make($password);
    }

    $user->update($request->only([
      'name', 'surname', 'email'
    ]));

    return back()->with('message', __('locale.Successfully updated user'));
  }

  /**
   * @param User $user
   * @return Application|RedirectResponse|Redirector
   * @throws Exception
   */
  public function destroy(User $user) {
    $user->delete();

    return redirect(route('dashboard.users.index'))
      ->with('message', __('locale.Successfully deleted user', ['name' => $user->name]));
  }
}
