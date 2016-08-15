<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'WorkController@index');
	Route::get('/about', 'PageController@about');
	Route::get('/contact', 'PageController@contact');
	Route::get('/login', 'PageController@login');

	// display single post
	Route::get('/{slug}',['as' => 'work', 'uses' => 'WorkController@show'])->where('slug', '[A-Za-z0-9-_]+');
});

Route::auth();

// New work form.
Route::get('/work/new','AdminController@create');
// Save work form.
Route::post('/work/new','AdminController@store');
// Edit work form
Route::get('/work/{slug}/edit','AdminController@edit');
// Update work
Route::post('/work/{slug}/edit','AdminController@update');
// Delete work
Route::get('/work/delete/{id}','AdminController@destroy');
