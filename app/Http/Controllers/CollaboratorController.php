<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\User;
use App\Services\CollaboratorService;
use App\Services\ConfigService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CollaboratorController extends Controller {
  private $collaboratorService;
  private $configService;

  public function __construct(ConfigService $configService, CollaboratorService $collaboratorService) {
    $this->configService = $configService;
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

    if ($this->configService->hasOverloadedCollaborators($email)) {
      return redirect(route('dashboard'))->withErrors([
        'errors' => 'Você já tem o máximo de colaboradores cadastrados, para adicionar mais colaboradores entre em contato com o desenvolvedor <a href="https://api.whatsapp.com/send?phone=5511993625697&text=Ol%C3%A1%20bruno%2C%20estou%20querendo%20mais%20colaboradores%20no%20meu%20DirectZap" target="__blank" >CLICANCO AQUI</a>'
      ]);
    }

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
