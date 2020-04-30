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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [
	'as' 	=> 'api.welcome',
	'uses' 	=> function(){
		return response()
			->json(['message'=>'Welcome to the Library Management System']);
	}
]);

Route::apiResource('/users','UserController');
Route::apiResource('/books','BookController');
Route::apiResource('/userbooks','UserBookController');

Route::group(['prefix' => 'auth'], function(){
	Route::get('/user', 'UserAuthController@userprofile');
	Route::post('/login', 'UserAuthController@login');
	Route::get('/user', 'UserAuthController@logout');
});
