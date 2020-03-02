<?php

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

Route::any('/admin{all}', function() {
	return view('admin/index');
})->where(['all'=> '.*'])->middleware('admin:manager');	


Route::group(['namespace'=> 'Theme'], function () {

	Route::get('/', function () {
		$title = 'Page Index';
		return view('theme.pages.index', compact('title') );
	})->name('home');

	Route::get('/category/:slug', function () {} )->name('theme.category');
	Route::get('/type/:slug', function () {} )->name('theme.type');
	Route::get('/history', function () {} )->name('theme.history');


	Route::get('/sign-in', 'AuthUser@getSignIn')->name('theme.getSignIn');
	Route::post('/sign-in', 'AuthUser@postSignIn')->name('theme.postSignIn');
	Route::get('/sign-up', 'AuthUser@getSignUp')->name('theme.getSignUp');
	Route::post('/sign-up', 'AuthUser@postSignUp')->name('theme.postSignUp');
	Route::get('/logout', 'AuthUser@logout')->name('logout');
});
