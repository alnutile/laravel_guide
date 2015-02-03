<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

use Illuminate\Support\Facades\Response;

Route::get('/', function()
{
	return View::make('hello');
});

/**
 * Authenticate
 */
Route::post('oauth/auth', 'OAuthController@postAuthorize');


/**
 * Incoming access token
 */
Route::post('oauth/access_token', function() {
	return Response::json(Authorizer::issueAccessToken());
});

/**
 * Need token for this
 */
Route::get('protected-resource', ['before' => 'oauth', function() {
	return Response::json("Protected API");
}]);