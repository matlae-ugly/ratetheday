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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/api-attributes', 'AttributesController@store');
Route::get('/api-attributes', 'AttributesController@get');
Route::delete('/api-attributes/{id}', 'AttributesController@delete');
Route::post('/api-ratetheday', 'RateTheDayController@store');
Route::post('/api-checkday', 'RateTheDayController@check');
