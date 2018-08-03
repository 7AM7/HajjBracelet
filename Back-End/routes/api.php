<?php

use Illuminate\Http\Request;


Route::group(array('prefix' => 'v1'), function () {


    Route::post('/auth/login','API\AuthController@login');
    Route::post('/auth/login/confirmation','API\AuthController@confirmLogin');


    Route::group(['middleware' => 'jwt'], function () {

	    Route::get('users/stores/transactions','API\UserController@getStoreTransactions');
	    Route::put('users/stores/transactions/{id}/confirm','API\UserController@confirmStoreTransaction');
	    Route::get('users/branches/transactions','API\UserController@getBranchTransactions');

	    Route::put('users/image','API\UserController@updateImage');
	    Route::put('users/pincode','API\UserController@updatePinCode');
	    Route::put('users/mobile','API\UserController@updateMobile');
	    Route::put('users/mobile/confirmation','API\UserController@updateMobileConfirm');
    	
    });

});
