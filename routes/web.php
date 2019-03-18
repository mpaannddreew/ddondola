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
})->name('welcome');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('web')->group(function (){
        Route::match(['get', 'post'], '/api', 'ApiController@query')->name('api');
    });

    Route::prefix('me')->group(function (){
        Route::get('/', 'HomeController@profile')->name('my.profile');
        Route::get('/edit', 'HomeController@editProfile')->name('my.profile.edit');
        Route::get('/edit/settings', 'HomeController@editProfileSettings')->name('my.profile.edit.settings');
        Route::get('/dashboard', 'HomeController@dashboard')->name('my.dashboard');
        Route::get('/messenger/{any?}', 'HomeController@messenger')->name('my.messenger');
        Route::get('/notifications', 'HomeController@notifications')->name('my.notifications');
        Route::get('/followers', 'HomeController@followers')->name('my.followers');
        Route::get('/following', 'HomeController@following')->name('my.following');
    });

    Route::prefix('users')->group(function (){
        Route::get('/', 'UserController@index')->name('users.index');
        Route::get('{user}', 'UserController@userProfile')->name('user.profile');
        Route::get('{user}/followers', 'UserController@userFollowers')->name('user.followers');
        Route::get('{user}/following', 'UserController@userFollowing')->name('user.following');
    });
});
