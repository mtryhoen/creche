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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/calendrier', function () {
//    return view('formcalendrier');
//});


Route::get('/bambi', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/calendrier', 'CalController@showcalendrieradmin');
Route::post('/calendrier/show', 'CalController@showcalendrier');
Route::post('/calendrier/save', 'CalController@savecalendrier');
Route::post('/calendrier/delete', 'CalController@deletecalendrier');

Route::get('/facturation', 'FacController@facturation');
Route::post('/facturation/show', 'FacController@showfacturation');

Route::get('/occupation', 'OccController@show');
Route::post('/occupation/show', 'OccController@showcalendrier');

Route::post('/users/show', 'UsersController@show');

Route::get('/enfants', 'EnfantsController@show');
Route::post('/enfants/save', 'EnfantsController@save');

//Admin routes
Route::get('/admin', ['middleware' => ['auth', 'admin'], function() {
    return view('welcome');
}]);

//Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
// Authentication routes...
Route::auth();


