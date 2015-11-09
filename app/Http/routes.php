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

use App\Models\User;
use GrizzDev\CMS\Listing;
use GrizzDev\CMS\Form;

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

//Route::get('/', function () {
	//return Listing::render(User::paginate(24));
	//return Form::render(User::find(1));
	//return Form::render(new User);
//});

Route::group([
	'middleware' => 'auth',
	'namespace' => 'CMS'
], function() {
	Route::group([
		//'middleware' => ['permission:heroes']
	], function() {
		Route::resource('heroes', 'HeroController');
	});

	Route::group([
		'prefix' => 'site',
		'namespace' => 'Site'
	], function() {
		Route::post('locations/create', 'LocationController@store');
		Route::resource('locations', 'LocationController');
		Route::post('users/create', 'UserController@store');
		Route::resource('users', 'UserController');
	});

	Route::group([
		'prefix' => 'shop',
		'namespace' => 'Shop'
	], function() {
		Route::group([
			//'middleware' => ['permission:products']
		], function() {
			Route::post('products/create', 'ProductController@store');
			Route::resource('products', 'ProductController');
			Route::post('attributes/create', 'AttributeController@store');
			Route::resource('attributes', 'AttributeController');
			Route::post('categories/create', 'CategoryController@store');
			Route::resource('categories', 'CategoryController');
			Route::post('tags/create', 'TagController@store');
			Route::resource('tags', 'TagController');
		});

		Route::group([
			//'middleware' => ['permission:orders']
		], function() {
			Route::post('orders/create', 'OrderController@store');
			Route::resource('orders', 'OrderController');
		});
	});

	Route::get('', 'DashboardController@index');
	Route::post('orders/data', 'Shop\OrderController@data');
	Route::post('{model}/data', 'DashboardController@data');
	Route::any('upload', 'DashboardController@upload');

});
