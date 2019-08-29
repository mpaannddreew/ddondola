<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 29/08/2019
 * Time: 16:22
 */

Route::namespace('Bank\Http\Controllers')->prefix('payments')->group(function () {
    Route::post('passed', 'BankController@passed');
    Route::post('failed', 'BankController@failed');
});