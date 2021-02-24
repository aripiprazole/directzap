<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller {
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
