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

Route::get('/login', 'View\MemberController@toLogin');

Route::get('/register', 'View\MemberController@toRegister');
Route::get('/smsTest', 'Service\ValidateController@sendSMS');
Route::get('/service/validate_phone/send', 'Service\ValidateController@sendSMS');


Route::any('service/validate_code/create','Service\ValidateController@create');
Route::post('service/register', 'Service\MemberController@register');