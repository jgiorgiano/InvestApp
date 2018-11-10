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
    return view('auth.login', [
        'home' => true
    ]);
});

Route::get('user/new', function(){return view('users.newUser');});
Route::post('newUser.store', ['as' => 'newUser.store', 'uses' => 'Auth\RegisterController@store']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/user', 'UsersController@index');


Route::get('moviments', ['as' => 'moviments.invest', 'uses' => 'MovimentsController@investing']);
Route::post('moviments', ['as' => 'moviments.invest.store', 'uses' => 'MovimentsController@storeInvest']);
Route::get('user.moviments', ['as' => 'moviments.index', 'uses' => 'MovimentsController@index']);
Route::get('user.moviments.all', ['as' => 'moviments.all', 'uses' => 'MovimentsController@all']);
Route::get('user.moviments.getBack', ['as' => 'moviments.getBack', 'uses' => 'MovimentsController@getBack']);
Route::post('user.moviments.getBackStore', ['as' => 'moviments.getBack.store', 'uses' => 'MovimentsController@getBackStore']);
 

Route::resource('user', 'UsersController');
Route::resource('institution', 'InstitutionsController');
Route::resource('group', 'GroupsController');
Route::resource('institution.products', 'ProductsController');


Route::post('group/{group_id}/user', ['as' => 'group.user.store', 'uses' => 'GroupsController@userStore']);
Route::delete('group/{group_id}/user/{user_id}', ['as' => 'group.user.destroy', 'uses' => 'GroupsController@userDestroy']);

