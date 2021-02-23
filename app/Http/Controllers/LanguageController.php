<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller {
  public function swap($locale): RedirectResponse {
    // available language in template array
    $availLocale = ['en' => 'en', 'fr' => 'fr', 'de' => 'de', 'pt' => 'pt'];
    // check for existing language
    if (array_key_exists($locale, $availLocale)) {
      session()->put('locale', $locale);
    }
    return redirect()->back();
  }
}
