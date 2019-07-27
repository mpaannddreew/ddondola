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

//Route::get('test', function (\Illuminate\Http\Request $request) {
//    return response()->json($request->user()->cart->getDenominations());
//});

Route::middleware(['web'])->group(function (){
    Route::get('/', function (\Shoppie\Repository\ProductRepository $products,
                              \Shoppie\Repository\ShopRepository $shops){
        return view('welcome', ['products' => $products->featured(6), 'shops' => $shops->featured(6)]);
    })->name('welcome');
    Route::view('contact', 'contact')->name('contact');
    Route::view('privacy-policy', 'privacy-policy')->name('policy');
    Route::view('terms-and-conditions', 'terms-and-conditions')->name('terms');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::prefix('me')->group(function (){
        Route::get('/', 'HomeController@profile')->name('my.profile');
        Route::get('/edit', 'HomeController@profileEdit')->name('my.profile.edit');
        Route::post('/update', 'HomeController@profileUpdate')->name('my.profile.update');
        Route::get('/change-password', 'HomeController@showChangePassword')->name('show.change.password');
        Route::post('/change-password', 'HomeController@updatePassword')->name('update.password');
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
