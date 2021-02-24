<?php

namespace App\Http\Controllers\Dashboard;

use App\Collaborator;
use App\Http\Controllers\Controller;
use App\Http\Requests\CollaboratorStoreRequest;
use App\Http\Requests\CollaboratorUpdateRequest;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CollaboratorController extends Controller {
  public function index(Request $request) {
    $breadcrumbs = [
      ['link' => "dashboard", 'name' => __('pages.Dashboard')], ['name' => __('pages.Collaborators')]
    ];

    return view('content.dashboard.collaborators', [
      'breadcrumbs' => $breadcrumbs,
      'user' => $request->user(),
      'collaborators' => Collaborator::query()->paginate(15)
    ]);
  }

  public function update(CollaboratorUpdateRequest $request, Collaborator $collaborator): RedirectResponse {
    $collaborator->update($request->only([
      'name', 'email', 'phone', 'message'
    ]));

    return back()->with('message', __('locale.Successfully updated collaborator'));
  }

  public function edit(Request $request, Collaborator $collaborator) {
    $breadcrumbs = [
      ['link' => "dashboard", 'name' => __('pages.Dashboard')],
      ['link' => "dashboard/collaborators", 'name' => __('pages.Collaborators')],
      ['name' => __('pages.Edit collaborator', ['name' => $collaborator->name])]
    ];

    return view('content.dashboard.collaborators.edit', [
      'breadcrumbs' => $breadcrumbs,
      'collaborator' => $collaborator,
      'user' => $request->user()
    ]);
  }

  public function store(CollaboratorStoreRequest $request): RedirectResponse {
    /** @var User $user */
    $user = $request->user();

    $user->collaborators()->create([
      'name' => $request->input('name'),
      'phone' => $request->input('phone'),
      'message' => $request->input('message'),
      'email' => $request->input('email'),
      'status' => Collaborator::ACTIVE,
      'total_count' => 0,
      'fill_count' => 0,
    ]);

    return redirect(route('dashboard.collaborators.index'))
      ->with('message', __('locale.Successfully created collaborator'));
  }

  public function create(Request $request) {
    $breadcrumbs = [
      ['link' => "dashboard", 'name' => __('pages.Dashboard')],
      ['link' => "dashboard/collaborators", 'name' => __('pages.Collaborators')],
      ['name' => __('Add collaborator')]
    ];

    return view('content.dashboard.collaborators.create', [
      'breadcrumbs' => $breadcrumbs,
      'user' => $request->user()
    ]);
  }

  public function pause(Collaborator $collaborator): RedirectResponse {
    $collaborator->status = $collaborator->invert();
    $collaborator->save();

    return back()
      ->with('message', __('locale.Successfully updated collaborator'));
  }

  public function clear(Collaborator $collaborator): RedirectResponse {
    $collaborator->total_count = 0;
    $collaborator->save();

    return back()
      ->with('message', __('locale.Successfully clean collaborator'));
  }

  /**
   * @param Collaborator $collaborator
   * @return Application|RedirectResponse|Redirector
   * @throws Exception
   */
  public function destroy(Collaborator $collaborator) {
    $collaborator->delete();

    return redirect(route('dashboard.collaborators.index'))
      ->with('message', __('locale.Successfully deleted collaborator', ['name' => $collaborator->name]));
  }
}
