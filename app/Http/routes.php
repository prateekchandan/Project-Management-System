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

Route::group(['middleware' =>[ 'web']],function(){
	Route::get('/', 'HomeController@index');
	Route::get('search', 'HomeController@search');
	Route::get('/tags/{tagname}', 'HomeController@tags');
	Route::get('/projects', 'HomeController@projectsAll');
	Route::get('/login', 'HomeController@login_view');
	Route::get('/logout', 'HomeController@logout');
	Route::post('/login', 'HomeController@login');
	Route::get('/project/{id}', 'HomeController@projectView');
	Route::get('/user/{userid}', 'HomeController@user');

	Route::get('/add-project', 'HomeController@add_project_view');
	Route::post('/add-project', 'HomeController@add_project');
	Route::get('/add-tag', 'HomeController@add_tag_view');
	Route::post('/add-tag', 'HomeController@add_tag');
	Route::get('/apply-project/{id}', 'HomeController@apply_project');

	Route::get('/signup', 'HomeController@signup_view');
	Route::post('/signup', 'HomeController@signup');

	Route::get('/change-working-status', 'HomeController@changeStatus');
	Route::post('/change-project-requirements', 'HomeController@changeRequirements');

	Route::get('/edit-project/{id}', 'HomeController@edit_project_view');
	Route::post('/edit-project/{id}', 'HomeController@edit_project');

});