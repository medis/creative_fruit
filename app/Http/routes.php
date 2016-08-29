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
	Route::get('/', ['as' => 'works', 'uses' => 'WorkController@index']);
	Route::get('/about', ['as' => 'about', 'uses' => 'PageController@about']);
	Route::get('/contact', ['as' => 'contact', 'uses' => 'PageController@contact']);
	Route::post('/contact', ['as' => 'contact_store', 'uses' => 'PageController@contactSave']);
	Route::get('/login', ['as' => 'login', 'uses' => 'PageController@login']);
	Route::get('/videos', ['as' => 'videos', 'uses' => 'WorkController@videos']);

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
// Show all works.
Route::get('/admin/works', ['as' => 'admin_works', 'uses' => 'AdminController@index']);

// Get file.
Route::get('fileentry/get/{filename}', [
	'as' => 'getentry', 'uses' => 'FileEntryController@get']);
Route::post('fileentry/upload', ['as' => 'upload-post', 'uses' =>'FileEntryController@store']);
Route::post('fileentry/delete', 'FileEntryController@destroy');

Route::group(['middleware' => ['auth']], function () {
	// Edit page.
	Route::get('/edit/{title}', ['as' => 'page_edit', 'uses' => 'PageController@edit']);
	// Update page.
	Route::post('/edit/{title}', 'PageController@update');
});
