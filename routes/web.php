<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['register' => false]);
// Home
Route::get('/', function () {
	return view('welcome');
});

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

//Auth::routes();
//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
//Route::post('post-login', 'App\Http\Controllers\Auth\LoginController@authenticate')->name('login.post'); 
//Route::get('login', [AuthController::class, 'index'])->name('login');

// DNS
Route::group(['middleware' => 'auth'], function () {
	Route::get('dns', function () {
		return view('dns.dns-list');
	})->name('dns');
	Route::get('dns/display/{records}', 'App\Http\Controllers\DnsController@display')->name('dns.display');
	Route::get('dns/delete/{name}', 'App\Http\Controllers\DnsController@delete')->name('dns.delete');
	Route::get('dns/a/ajout', 'App\Http\Controllers\DnsController@ajout')->name('dns.ajout');
	Route::post('dns/a/ajout', 'App\Http\Controllers\DnsController@createdata')->name('dns.createData');
	Route::get('dns/edit/{data}', 'App\Http\Controllers\DnsController@edit')->name('dns.edit');
	Route::post('dns/update', 'App\Http\Controllers\DnsController@update')->name('dns.update');
});

// Profile
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

//Liens
Route::group(['middleware' => 'auth'], function () {
	Route::get('link', 'App\Http\Controllers\LiensController@show')->name('link');
	Route::get('link/ajout', 'App\Http\Controllers\LiensController@ajout')->name('link.ajout');
	Route::post('link/ajout', 'App\Http\Controllers\LiensController@create')->name('link.create');
	Route::get('link/delete/{nomSite}', 'App\Http\Controllers\LiensController@delete');
	Route::get('link/edit/{id}', 'App\Http\Controllers\LiensController@edit');
	Route::post('link/update/{id}', 'App\Http\Controllers\LiensController@update')->name('link.update');
});