<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/braip', 'ActivationController@webhook');
Route::any('/v1/braip', 'ActivationController@webhook');

Route::any('/v1/pixels/{name}', function (Request $request) {
  $code = $request->query('code');

  return App\Configuration::findByCode($code)->pix;
});
