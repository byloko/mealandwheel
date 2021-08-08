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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('app_register_login', 'APIController@app_register_login');
Route::post('app_store_mobile_otp', 'APIController@app_store_mobile_otp');
Route::post('app_verify_otp', 'APIController@app_verify_otp');
Route::post('app_resend_otp', 'APIController@app_resend_otp');
Route::post('app_social_login', 'APIController@app_social_login');

Route::post('app_create_your_profile', 'APIController@app_create_your_profile');
Route::post('app_bank_detail', 'APIController@app_bank_detail');

Route::post('app_order_list', 'APIController@app_order_list');

Route::post('app_profile_list', 'APIController@app_profile_list');

Route::post('app_home_list', 'APIController@app_home_list');
Route::post('app_order_status_update', 'APIController@app_order_status_update');
Route::post('app_add_item', 'APIController@app_add_item');

Route::post('app_westway_food_menu_list', 'APIController@app_westway_food_menu_list');
Route::post('app_version_setting_update', 'APIController@app_version_setting_update');

Route::post('app_best_sellers_list', 'APIController@app_best_sellers_list');

Route::post('app_min_and_max', 'APIController@app_min_and_max');