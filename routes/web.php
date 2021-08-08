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

Route::get('/', function () {
    return view('welcome');
});

// Backend Start
Route::get('admin/login', 'AuthController@login');
Route::post('admin/login', 'AuthController@post_login');
Route::get('admin/logout', 'AuthController@logout');


Route::group(['middleware' => 'superadmin'], function () {


});

Route::group(['middleware' => 'admin'], function(){

	Route::get('admin/dashboard', 'Backend\DashboardController@dashboard_index');

	Route::get('admin/user', 'Backend\UserController@user_index');
	Route::get('admin/user/add', 'Backend\UserController@user_create');
	Route::post('admin/user/add', 'Backend\UserController@user_store');
	Route::get('admin/user/view/{id}', 'Backend\UserController@user_show');
	Route::get('admin/user/edit/{id}', 'Backend\UserController@user_edit');
	Route::post('admin/user/edit/{id}', 'Backend\UserController@user_update');
	Route::get('admin/user/delete/{id}', 'Backend\UserController@user_destroy');

	Route::get('admin/hotel', 'Backend\HotelController@hotel_index');
	Route::get('admin/hotel/add', 'Backend\HotelController@hotel_create');
	Route::post('admin/hotel/add', 'Backend\HotelController@hotel_store');
	Route::get('admin/hotel/edit/{id}', 'Backend\HotelController@hotel_edit');
	Route::post('admin/hotel/edit/{id}', 'Backend\HotelController@hotel_update');
	Route::get('admin/hotel/delete/{id}', 'Backend\HotelController@hotel_destroy');

	Route::get('admin/food_menu', 'Backend\FoodMenuController@food_menu_index');
	Route::get('admin/food_menu/add', 'Backend\FoodMenuController@food_menu_create');
	Route::post('admin/food_menu/add', 'Backend\FoodMenuController@food_menu_store_update');
	Route::get('admin/food_menu/edit/{id}', 'Backend\FoodMenuController@food_menu_store_edit');
	Route::post('admin/food_menu/edit/{id}', 'Backend\FoodMenuController@food_menu_store_update');
	Route::get('admin/food_menu/delete/{id}', 'Backend\FoodMenuController@food_menu_store_destroy');

	Route::get('admin/food_sub_menu', 'Backend\FoodSubMenuController@food_sub_menu_index');
	Route::get('admin/food_sub_menu/add', 'Backend\FoodSubMenuController@food_sub_menu_create');
	Route::post('admin/food_sub_menu/add', 'Backend\FoodSubMenuController@food_sub_menu_store');
	Route::get('admin/food_sub_menu/edit/{id}', 'Backend\FoodSubMenuController@food_sub_menu_edit');
	Route::post('admin/food_sub_menu/edit/{id}', 'Backend\FoodSubMenuController@food_sub_menu_update');
	Route::get('admin/food_sub_menu/delete/{id}', 'Backend\FoodSubMenuController@food_sub_menu_destroy');

	Route::get('admin/version_setting', 'Backend\VersionSettingController@version_setting_index');
	Route::post('admin/version_setting/add', 'Backend\VersionSettingController@version_setting_insert');

	Route::get('admin/order_food', 'Backend\OrderFoodController@order_food_index');
	Route::get('admin/order_food/add', 'Backend\OrderFoodController@order_food_create');
	Route::post('admin/order_food/add', 'Backend\OrderFoodController@order_food_store');
	Route::get('admin/order_food/view/{id}', 'Backend\OrderFoodController@order_food_show');
	Route::get('admin/order_food/edit/{id}', 'Backend\OrderFoodController@order_food_edit');
	Route::post('admin/order_food/edit/{id}', 'Backend\OrderFoodController@order_food_update');
	Route::get('admin/order_food/delete/{id}', 'Backend\OrderFoodController@order_food_destroy');



	Route::get('admin/best_seller', 'Backend\BestSellerController@best_seller_index');
	Route::get('admin/best_seller/add', 'Backend\BestSellerController@best_seller_create');
	Route::post('admin/best_seller/add', 'Backend\BestSellerController@best_seller_store');
	Route::get('admin/best_seller/edit/{id}', 'Backend\BestSellerController@best_seller_edit');
	Route::post('admin/best_seller/edit/{id}', 'Backend\BestSellerController@best_seller_update');
	Route::get('admin/best_seller/delete/{id}', 'Backend\BestSellerController@best_seller_destroy');

});


// Backend End