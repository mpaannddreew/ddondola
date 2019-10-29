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

use Illuminate\Support\Facades\Auth;

Route::middleware(['web'])->group(function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::view('contact', 'contact')->name('contact');
    Route::view('privacy-policy', 'privacy-policy')->name('policy');
    Route::view('terms-and-conditions', 'terms-and-conditions')->name('terms');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function (){
    Route::prefix('me')->group(function (){
        Route::get('/', 'HomeController@profile')->name('my.profile');
        Route::get('edit', 'HomeController@profileEdit')->name('my.profile.edit');
        Route::post('update', 'HomeController@profileUpdate')->name('my.profile.update');
        Route::get('change-password', 'HomeController@showChangePassword')->name('show.change.password');
        Route::post('change-password', 'HomeController@updatePassword')->name('update.password');
        Route::get('dashboard', 'HomeController@dashboard')->name('my.dashboard');
        Route::get('messenger/{participant?}', 'HomeController@messenger')->name('my.messenger');
        Route::get('notifications', 'HomeController@notifications')->name('my.notifications');
        Route::get('followers', 'HomeController@followers')->name('my.followers');
        Route::get('following', 'HomeController@following')->name('my.following');
        Route::prefix('wallet')->group(function () {
            Route::get('/', 'HomeController@wallet')->name('my.wallet');
            Route::get('deposit', 'HomeController@wallet')->name('my.wallet.deposit');
            Route::get('withdraw', 'HomeController@wallet')->name('my.wallet.withdraw');
        });
    });
    Route::middleware(['admin.staff'])->prefix('admin')->group(function (){
        Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('users/{user?}', 'AdminController@users')->name('admin.users');
    });
});

Route::prefix('people')->group(function (){
    Route::get('/', 'UserController@index')->name('users.index');
    Route::get('{user}', 'UserController@userProfile')->name('user.profile');
    Route::get('{user}/followers', 'UserController@userFollowers')->name('user.followers');
    Route::get('{user}/following', 'UserController@userFollowing')->name('user.following');
});
