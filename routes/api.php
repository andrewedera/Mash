<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('campaign', 'CampaignController')->except([
    'create', 'show'
]);

Route::resource('domain', 'DomainController')->only([
    'store', 'update', 'destroy'
]);

Route::resource('server', 'ServerController')->only([
    'store'
]);

Route::get('/rotator', 'SettingController@indexRotator');
Route::put('/rotator', 'SettingController@editRotator');
Route::get('/keys', 'SettingController@indexKeys');
Route::put('/keys', 'SettingController@editKeys');