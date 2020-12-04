<?php

use App\Models\Code;
use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('api/v1')->name('api.')->group(function () {
  Route::post('signup', 'AuthController@signup')->name('signup');
  Route::post('login', 'AuthController@login')->name('login');
  Route::any('logout', 'AuthController@logout')->name('logout');

  Route::middleware('auth:web')->group(function () {
    Route::prefix('pixels')->name('pixels.')->group(function () {
      Route::post('/', 'PixelController@store')->name('store');
    });

    Route::prefix('codes')->name('codes.')->group(function () {
      Route::post('/', 'CodeController@store')->name('store');
    });

    Route::prefix('configs')->name('configs.')->group(function () {
      Route::post('/', 'ConfigurationController@store')->name('store');
    });

    Route::prefix('collaborators')->name('collaborators.')->group(function () {
      Route::post('/', 'CollaboratorController@store')->name('store');
      Route::post('{collaboratorId}/update', 'CollaboratorController@update')->name('update');
      Route::post('{collaboratorId}/destroy', 'CollaboratorController@destroy')->name('destroy');
    });
  });
});

Route::get('/', function () {
  return redirect(route('login'));
});

Route::middleware('guest')->get('/membros', function () {
  return view('login');
})->name('login');

Route::middleware('guest')->get('/membros/cadastro', function () {
  return view('signup');
})->name('signup');

Route::middleware('auth:web')->group(function () {
  Route::get('delete-modal/{collaborator}', function (Collaborator $collaborator) {
    return view('delete-collaborator', compact('collaborator'));
  })->name('delete-collaborator');

  Route::get('edit-modal/{collaborator}', function (Collaborator $collaborator) {
    return view('edit-collaborator', compact('collaborator'));
  })->name('edit-collaborator');

  Route::get('/membros/admin/dashboard', function (Request $request) {
    /** @var User $user */
    $user = $request->user();

    $url = config('app.fb_ads_url');
    $code = optional(Code::query()->where('email', $user->email)->first())->code;

    return view('dashboard', [
      'user' => $request->user(),
      'code' => $code,
      'link_direct' => route('user', [
        'name' => $user->full_name,
        'cod' => $code
      ]),
      'link_facebook_ads' => "$url/".rawurlencode($user->full_name).'?cod='.rawurlencode($code),
      'collaborators' => $user->collaborators()
    ]);
  })->name('dashboard');
});

Route::get('{name}', 'UpdaterController@increase')->name('user');
