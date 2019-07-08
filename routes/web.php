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

//use FannyPack\LaracombeeMultiDB\MultiDBFacade;

//use Illuminate\Support\Facades\Auth;

//Route::get('test', function () {
//    Auth::user()->cart->checkOut();
//    $recommendations = MultiDBFacade::db('shop-mine')->recommendTo(\Illuminate\Support\Facades\Auth::user(), 10)->wait();
//    return response()->json(['success' => $recommendations['recomms']]);
//    return response()->json(app(\Shoppie\Repository\ShopRepository::class)->id(1)->orderIds());
//});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::prefix('me')->group(function (){
        Route::get('/', 'HomeController@profile')->name('my.profile');
        Route::get('/settings', 'HomeController@Settings')->name('my.settings');
        Route::get('/dashboard', 'HomeController@dashboard')->name('my.dashboard');
        Route::get('/messenger/{participant?}', 'HomeController@messenger')->name('my.messenger');
        Route::get('/notifications', 'HomeController@notifications')->name('my.notifications');
        Route::get('/followers', 'HomeController@followers')->name('my.followers');
        Route::get('/following', 'HomeController@following')->name('my.following');
    });
    Route::middleware(['admin.staff'])->prefix('admin')->group(function (){
        Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('users/{user?}', 'AdminController@users')->name('admin.users');
    });
});

Route::prefix('web')->group(function (){
    Route::match(['get', 'post'], '/api', 'ApiController@query')->name('api');
});

Route::prefix('people')->group(function (){
    Route::get('/', 'UserController@index')->name('users.index')->middleware(['auth', 'verified']);
    Route::get('{user}', 'UserController@userProfile')->name('user.profile');
    Route::get('{user}/followers', 'UserController@userFollowers')->name('user.followers');
    Route::get('{user}/following', 'UserController@userFollowing')->name('user.following');
});
