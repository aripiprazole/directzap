<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller {
  public function activate(Request $request) {
    /** @var User $user */
    $user = $request->user();

    if ($user->active) {
      return redirect(route('dashboard.index'));
    }

    return view('content.dashboard.activate');
  }

  public function settings(Request $request) {
    $breadcrumbs = [
      ['link' => "dashboard", 'name' => __('pages.Dashboard')], ['name' => __('pages.Settings')]
    ];

    return view('content.dashboard.settings', [
      'breadcrumbs' => $breadcrumbs,
      'user' => $request->user()
    ]);
  }

  public function dashboard(Request $request) {
    $breadcrumbs = [
      ['link' => "dashboard", 'name' => __('pages.Dashboard')], ['name' => __('pages.Home')]
    ];

    return view('content.dashboard', [
      'breadcrumbs' => $breadcrumbs,
      'user' => $request->user()
    ]);
  }
}
