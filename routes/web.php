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

Route::get('/register', 'articleController@get_register');
Route::post('/register', 'articleController@register');
Route::get('/register/confirm/{token}', 'articleController@confirmEmail');
Route::get('/', 'articleController@get_login');
Route::post('/login', 'articleController@login');

Route::group(['middleware'=>'auth'], function(){
	Route::get('/home','articleController@get_home');
	Route::post('/home','articleController@home');
	Route::get('/logout','articleController@get_logout');
	Route::get('/newarticle','articleController@get_newarticle');
	Route::post('/newarticle','articleController@newarticle');
	Route::get('/myarticle','articleController@get_myarticle');
	Route::post('/myarticle','articleController@myarticle');
	Route::post('/Delete','articleController@get_Delete');
	Route::get('/user','articleController@get_user');
	Route::post('/profileUpdate','articleController@profileUpdate');
	Route::get('/{id}/profile','articleController@get_profile');
});
Route::get('/login',['as'=>'login','uses'=>'articleController@get_login']);

Route::get('password/reset',['as'=>'password.request','uses'=>'Auth\ForgotPasswordController@showLinkRequestForm']);

Route::post('password/email',['as'=>'password.email','uses'=>'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}',['as'=>'password.reset','uses'=>'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset','Auth\ResetPasswordController@reset');
