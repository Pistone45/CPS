<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleContro;

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

//Display welcome page
Route::get('/', function () {
    return view('welcome');
});

//Login and Register links
Auth::routes();

//Home routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Roles routes
Route::get('/roles', 'RoleController@index')->name('roles.home');

//Send SMS routes
Route::get('send-sms', [SendSMSController::class, 'index']);

//Users routes
Route::get('/users', 'UserController@index')->name('users.home');
Route::get('get', 'UserController@get')->name('users.datatable');
Route::get('users/add', 'UserController@add')->name('users.add');
Route::post('users/register', 'UserController@register')->name('users.register');
Route::get('users/edit/{user}', 'UserController@editform')->name('users.editform');
Route::patch('users/{user}', 'UserController@update')->name('users.update');