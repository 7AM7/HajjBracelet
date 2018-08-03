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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ###################### CLIENTS
Route::get('/clients', 'Admin\ClientController@index');
Route::get('/clients/create', 'Admin\ClientController@create');
Route::post('/clients/store', 'Admin\ClientController@store')->name('client.store');
Route::get('/clients/{id}/edit', 'Admin\ClientController@edit');
Route::post('/clients/{id}/update', 'Admin\ClientController@update')->name('client.update');
Route::post('/clients/{id}/destroy', 'Admin\ClientController@destroy');

// ###################### Store
Route::get('/stores', 'Admin\StoreController@index');
Route::get('/stores/create', 'Admin\StoreController@create');
Route::post('/stores/store', 'Admin\StoreController@store')->name('store.store');
Route::get('/stores/{id}/edit', 'Admin\StoreController@edit');
Route::post('/stores/{id}/update', 'Admin\StoreController@update')->name('store.update');
Route::post('/stores/{id}/destroy', 'Admin\StoreController@destroy');

// ###################### STORE ADMINS
Route::get('/stores/{id}/admins', 'Admin\StoreAdminController@index');
Route::get('/stores/{id}/admins/create', 'Admin\StoreAdminController@create');
Route::post('/stores/{id}/admins/store', 'Admin\StoreAdminController@store')->name('storeadmin.store');
Route::get('/stores/{id}/admins/{adminId}/edit', 'Admin\StoreAdminController@edit');
Route::post('/stores/{id}/admins/{adminId}/update','Admin\StoreAdminController@store')->name('storeadmin.update');
Route::post('/stores/{id}/admins/{adminId}/destroy','Admin\StoreAdminController@destroy')->name('storeadmin.destroy');


// ###################### STORE BRANCH TRANSACTIONS
Route::get('/stores/{id}/transactions', 'Admin\StoreBranchTransactionController@index');
Route::get('/stores/{id}/transactions/create', 'Admin\StoreBranchTransactionController@create');
Route::post('/stores/{id}/transactions/store', 'Admin\StoreBranchTransactionController@store')->name('storebranchtransaction.store');
Route::get('/stores/{id}/transactions/{tansactionId}/edit', 'Admin\StoreBranchTransactionController@edit');
Route::post('/stores/{id}/transactions/{tansactionId}/update','Admin\StoreBranchTransactionController@store')->name('storebranchtransaction.update');
Route::post('/stores/{id}/transactions/{tansactionId}/destroy','Admin\StoreBranchTransactionController@destroy')->name('storebranchtransaction.destroy');



// ###################### CLIENT BRANCH TRANSACTIONS
Route::get('/clients/{id}/transactions', 'Admin\ClientBranchTransactionController@index');
Route::get('/clients/{id}/transactions/create', 'Admin\ClientBranchTransactionController@create');
Route::post('/clients/{id}/transactions/store', 'Admin\ClientBranchTransactionController@store')->name('userbranchtransaction.store');
Route::get('/clients/{id}/transactions/{tansactionId}/edit', 'Admin\ClientBranchTransactionController@edit');
Route::post('/clients/{id}/transactions/{tansactionId}/update','Admin\ClientBranchTransactionController@store')->name('userbranchtransaction.update');
Route::post('/clients/{id}/transactions/{tansactionId}/destroy','Admin\ClientBranchTransactionController@destroy')->name('userbranchtransaction.destroy');


// ###################### USER STORE TRANSACTIONS
Route::get('/transactions', 'Admin\UserStoreTransactionController@index');
Route::get('/transactions/create', 'Admin\UserStoreTransactionController@create');
Route::post('/transactions/store', 'Admin\UserStoreTransactionController@store')->name('transactions.store');
Route::get('/transactions/{id}/edit', 'Admin\UserStoreTransactionController@edit');
Route::post('/transactions/{id}/update', 'Admin\UserStoreTransactionController@update')->name('transactions.update');
Route::post('/transactions/{id}/destroy', 'Admin\UserStoreTransactionController@destroy');
Route::post('/transactions/{id}/confirmation', 'Admin\UserStoreTransactionController@confirmation')->name('transactions.confirmation');
