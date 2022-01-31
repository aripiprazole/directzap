<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', 'DashboardController@dashboard')->name('index');

Route::middleware('auth:web')->prefix('/dashboard')->name('dashboard.')->group(function () {
  Route::get('/activate', 'DashboardController@activate');
  Route::post('/activate', 'ActivationController@self')->name('activate');
  Route::get('/settings', 'DashboardController@settings')->name('settings');

  Route::prefix('/users')->name('users.')->group(function () {
    Route::get('/avatar/me', 'Dashboard\MeController@avatar')->name('avatar.me');
    Route::post('/update/me', 'Dashboard\MeController@update')->name('update.me');
    Route::post('/update/me/password', 'Dashboard\MeController@updatePassword')->name('update.me.password');

    Route::middleware('can:viewAny,App\User')
      ->get('/', 'Dashboard\UserController@index')
      ->name('index');

    Route::middleware('can:update,user')->group(function () {
      Route::get('/edit/{user}', 'Dashboard\UserController@edit')->name('edit');
      Route::post('/update/{user}', 'Dashboard\UserController@update')->name('update');
      Route::post('/activate/{user}', 'ActivationController@manual')->name('activate');
    });

    Route::middleware('can:delete,user')->post('/destroy/{user}', 'Dashboard\UserController@destroy')->name('destroy');
  });

  Route::prefix('/configurations')->name('configurations.')->group(function () {
    Route::post('/update/me', 'Dashboard\MeConfigurationController@update')->name('update.me');
    Route::post('/refresh/me', 'Dashboard\MeConfigurationController@refresh')->name('refresh.me');

    Route::middleware('can:update,configuration')
      ->post('/update/{configuration}', 'Dashboard\ConfigurationController@update')
      ->name('update');
  });

  Route::prefix('/collaborators')->name('collaborators.')->group(function () {
    Route::get('/', 'Dashboard\CollaboratorController@index')->name('index');
    Route::get('/create', 'Dashboard\CollaboratorController@create')->name('create');
    Route::get('/edit/{collaborator}', 'Dashboard\CollaboratorController@edit')->name('edit');

    Route::middleware('can:create,App\Collaborator')
      ->post('/store', 'Dashboard\CollaboratorController@store')
      ->name('store');

    Route::middleware('can:delete,collaborator')
      ->post('/destroy/{collaborator}', 'Dashboard\CollaboratorController@destroy')
      ->name('destroy');

    Route::middleware('can:update,collaborator')->group(function () {
      Route::post('/clear/{collaborator}', 'Dashboard\CollaboratorController@clear')->name('clear');
      Route::post('/pause/{collaborator}', 'Dashboard\CollaboratorController@pause')->name('pause');
      Route::post('/update/{collaborator}', 'Dashboard\CollaboratorController@update')->name('update');
    });
  });
});

Route::get('/dashboard/users/avatar/{user}', 'Dashboard\UserController@avatar')->name('dashboard.users.avatar');

Route::get('/{name?}', 'ConversionController')->name('conversion');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
