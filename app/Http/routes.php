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
		Route::resource('nominations', 'NominationController');
		Route::get('nominations/{id}/approve', 'NominationController@approve');
		Route::get('nominations/{id}/deny', 'NominationController@deny');
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

			Route::post('coupons/create', 'CouponController@store');
			Route::resource('coupons', 'CouponController');
		});

		Route::group([
			//'middleware' => ['permission:orders']
		], function() {
			Route::post('orders/create', 'OrderController@store');
			Route::resource('orders', 'OrderController');

			Route::get('reports', function() {
				return redirect('shop/reports/orders');
			});
			Route::any('reports/orders', 'ReportController@orders');
			Route::any('reports/products', 'ReportController@products');
		});
	});

	Route::get('events', 'Events\EventController@index');
	Route::get('events/{id}', function($id) {
		return redirect()->to('/event/'.$id);
	});
	Route::group([
		'prefix' => 'event',
		'namespace' => 'Events'
	], function() {
		Route::get('create', 'EventController@create');
		Route::post('create', 'EventController@store');
		Route::get('{id}', 'EventController@event');
		Route::put('{id}', 'EventController@update');

		Route::get('{event_id}/job/create', 'JobController@create');
		Route::post('{event_id}/job/create', 'JobController@store');
		Route::get('{event_id}/job/{id}', 'JobController@job');
		Route::put('{event_id}/job/{id}', 'JobController@update');

		Route::get('{event_id}/shift/create', 'ShiftController@create');
		Route::post('{event_id}/shift/create', 'ShiftController@store');
		Route::get('{event_id}/shift/{id}', 'ShiftController@shift');
		Route::put('{event_id}/shift/{id}', 'ShiftController@update');
	});

	Route::get('', 'DashboardController@index');
	Route::post('orders/data', 'Shop\OrderController@data');
	Route::post('{model}/data', 'DashboardController@data');
	Route::get('{model}/json', 'DashboardController@json');
	Route::any('upload', 'DashboardController@upload');

});
