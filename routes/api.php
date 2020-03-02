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


Route::group(['prefix' => 'admin', 'middleware' => 'admin.api:manager', 'namespace' => 'Admin' ], function () {

	Route::get('/me', function (Request $rq) {
		return response()->json($rq->user());
	});

	/* FILM */
	Route::group(['prefix' => 'films'], function () {
		Route::get('/', 'FilmController@index');
		Route::post('/', 'FilmController@store');
		Route::get('/{id}', 'FilmController@edit');
		Route::put('/{id}', 'FilmController@update');
		Route::delete('/{id}', 'FilmController@delete');

		Route::group(['prefix' => '/{fid}/episodes'], function () {
			Route::get('/', 'EpisodeController@index');
			Route::post('/', 'EpisodeController@store');
			Route::put('/{id}', 'EpisodeController@update');
			Route::delete('/{id}', 'EpisodeController@delete');
		});
	});
	
	Route::get('/all-episodes', 'EpisodeController@all');


	Route::group(['prefix' => 'types'], function () {
		Route::get('/', 'TypeController@index');
		Route::post('/', 'TypeController@store');
		Route::put('/{id}', 'TypeController@update');
		Route::delete('/{id}', 'TypeController@delete');
	});

	Route::group(['prefix' => 'categories'], function () {
		Route::get('/', 'CategoryController@index');
		Route::post('/', 'CategoryController@store');
		Route::put('/{id}', 'CategoryController@update');
		Route::delete('/{id}', 'CategoryController@delete');
	});



});