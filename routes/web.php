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

Route::get('/', 'SiteController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/articulos', 'ArticleController@todos');
Route::get('/articulo/{articulo}/{user_code?}', 'ArticleController@article');
Route::get('/articulo/{articulo}/{user}/{origen}', 'ArticleController@registro');

//Perfil y configuración
Route::get('/perfil', 'SiteController@perfil');
Route::get('/config', 'SiteController@config');

//registrar link
Route::get('/insert/{articulo}/{user}/{type}', 'SharedController@insert');

//update
Route::post('/config/personal', 'ConfigController@personal');
Route::post('/config/contacto', 'ConfigController@contacto');
Route::post('/config/city', 'ConfigController@city');
Route::post('/config/testigo', 'ConfigController@testigo');


//Socialite routes
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

//generador de imagenes
Route::get('/img', 'SiteController@img');

//politica de privaciodad
Route::get('/privacidad', 'SiteController@privacidad');

//registro de E-14
//Route::get('/reporte', 'ReportController@vista');
//Route::post('/reporte/registro', 'ReportController@registro');
