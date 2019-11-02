<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 29/08/2019
 * Time: 16:22
 */

Route::namespace('Bank\Http\Controllers')->group(function () {
    Route::prefix('payments')->group(function () {
        Route::post('passed', 'BankController@passed');
        Route::post('failed', 'BankController@failed');
    });

    Route::prefix('admin')->group(function () {
        Route::prefix('wallet')->group(function () {
            Route::get('/', 'BankController@wallet')->name('admin.wallet');
            Route::get('deposit', 'BankController@wallet')->name('admin.wallet.deposit');
            Route::get('withdraw', 'BankController@wallet')->name('admin.wallet.withdraw');
            Route::get('escrow', 'BankController@wallet')->name('admin.wallet.escrow');
        });
    });
});