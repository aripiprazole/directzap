<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\User;
use App\Services\CollaboratorService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CollaboratorController extends Controller {
  /** @var CollaboratorService */
  private $collaboratorService;

  public function __construct(CollaboratorService $collaboratorService) {
    $this->collaboratorService = $collaboratorService;
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request): RedirectResponse {
    /** @var User $user */
    $user = $request->user();

    $phone = $request->input('phone');
    $message = $request->input('message');
    $name = $request->input('name');
    $person_link = '';

    $email = $user->email;

    $body = compact('phone', 'message', 'person_link', 'name', 'email');

    $this->collaboratorService->createCollaborator(array_merge($body, [
      'link' => "whatsapp://send?text=$message&phone=+55$phone",
      'person_link' => ''
    ]));

    return redirect(route('dashboard'));
  }

  /**
   * @param Collaborator $collaborator
   * @param Request $request
   * @return RedirectResponse
   */
  public function update(Collaborator $collaborator, Request $request): RedirectResponse {
    $collaborator->update($request->only([
      'name',
      'person_link',
      'whatsapp_link',
      'message',
      'phone',
      'email',
    ]));

    return redirect(route('dashboard'));
  }

  /**
   * @param Collaborator $collaborator
   * @return RedirectResponse
   */
  public function pause(Collaborator $collaborator): RedirectResponse {
    $collaborator->update([
      'paused' => !$collaborator->paused
    ]);

    return redirect(route('dashboard'));
  }

  /**
   * @param Collaborator $collaborator
   * @return RedirectResponse
   * @throws Exception
   */
  public function destroy(Collaborator $collaborator): RedirectResponse {
    $collaborator->delete();

    return redirect(route('dashboard'));
  }
}
