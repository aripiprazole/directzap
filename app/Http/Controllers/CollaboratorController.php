<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CollaboratorController extends Controller {
  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request) {
    $phone = $request->input('phone');
    $message = $request->input('message');
    $name = $request->input('name');
    $person_link = '';

    /** @var User $user */
    $user = $request->user();
    $email = $user->email;

    $body = compact('phone', 'message', 'person_link', 'name', 'email');

    Collaborator::query()->create(array_merge($body, [
      'link' => "whatsapp://send?text=$message&phone=+55$phone"
    ]));

    return redirect(route('dashboard'));
  }

  /**
   * @param int $collaboratorId
   * @param Request $request
   * @return RedirectResponse
   */
  public function update(int $collaboratorId, Request $request) {
    $collaborator = Collaborator::query()->findOrFail($collaboratorId);

    $body = $request->only([
      'name',
      'person_link',
      'whatsapp_link',
      'message',
      'phone',
      'email',
    ]);

    $collaborator->update(array_merge($body, [
      'paused' => $request->input('paused') === 'yes'
    ]));

    return redirect(route('dashboard'));
  }

  /**
   * @param int $collaboratorId
   * @return RedirectResponse
   * @throws Exception
   */
  public function destroy(int $collaboratorId) {
    $collaborator = Collaborator::query()->findOrFail($collaboratorId);
    $collaborator->delete();

    return redirect(route('dashboard'));
  }
}
