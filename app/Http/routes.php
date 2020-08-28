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

use App\Entity\Member;

Route::get('/', function () {
     return view('login');
    // return Member::all();
});

// 对于试图类一般用get
Route::get('/login', 'View\MemberController@toLogin');
Route::get('/register', 'View\MemberController@toRegister');
Route::get('/smsTest', 'Service\ValidateController@sendSMS');
Route::get('/product/category_id/{category_id}', 'View\BookController@toProduct');

Route::get('/category', 'View\BookController@toCategory');
// 对于接口类一般用post
// Middleware To assign middleware to all routes within a group, you may use the middleware key 
//in the group attribute array. Middleware will be executed in the order you define this array:

// Route::get('/service/validate_phone/send', 'Service\ValidateController@sendSMS');
// Route::get('/service/testEmail', 'Service\ValidateController@testEmail');
// Route::any('service/validate_code/create','Service\ValidateController@create');
// Route::post('service/register', 'Service\MemberController@register');

Route::group(['prefix' => 'service'], function () {
    Route::get('validate_code/create', 'Service\ValidateController@create');
    Route::post('validate_phone/send', 'Service\ValidateController@sendSMS');
    Route::post('register', 'Service\MemberController@register');
    Route::post('login', 'Service\MemberController@login');
    Route::get('category/parent_id/{parent_id}', 'Service\BookController@getCategoryByParentId');

  });