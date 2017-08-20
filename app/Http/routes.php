<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/admin', function(){

	return view ('admin.index');
});


Route::group(['middleware'=>'admin'], function(){

	Route::resource('admin/users', 'AdminUsersController');

	Route::resource('admin/clients', 'AdminClientsController');

	Route::resource('admin/lists/coa', 'AdminCoasController');

    Route::resource('admin/lists/vat', 'AdminVatsController');

    Route::resource('admin/lists/business', 'AdminBusinessesController');

    Route::resource('admin/lists/document', 'AdminDocumentController');

    Route::resource('admin/management/assign', 'AdminClientUserController');

    Route::resource('admin/management/team', 'AdminTeamsController');

    Route::resource('admin/management/logs', 'AdminLogsController');

    Route::resource('admin/management/task', 'AdminTasksController');

});

Route::group(['middleware'=>'auth'], function(){

    Route::resource('user/{client_id}/home', 'UserHomeController');

	Route::resource('user/accounting/vat', 'UserVatsController');

    Route::resource('user/accounting/transaction', 'UserTransactionsController');

    Route::resource('user/{client_id}/accounting/journal', 'UserJournalsController');

    Route::get('user/{client_id}/accounting/journal', ['as' => 'journal', 'uses' => 'UserJournalsController@index']);

    Route::resource('user/{client_id}/accounting/coa', 'UserCoasController');

    Route::resource('user/{client_id}/accounting/coa/create', 'UserCoasController@create');

    Route::resource('user/{client_id}/accounting/coa/edit', 'UserCoasController@edit');

	Route::resource('user/{client_id}/payable/vendor', 'UserVendorController');

    Route::get('user/{client_id}/payable/vendor', ['as' => 'vendor', 'uses' => 'UserVendorController@index']);

	Route::resource('user/{client_id}/payable/vendor/create', 'UserVendorController@create');

    Route::resource('user/{client_id}/payable/vendor/edit', 'UserVendorController@edit');


    Route::resource('user/{client_id}/payable/bill', 'UserBillsController');

    Route::get('user/{client_id}/payable/bill', ['as' => 'bill', 'uses' => 'UserBillsController@index']);

    Route::resource('user/{client_id}/receivable/customer', 'UserCustomerController');

    Route::get('user/{client_id}/receivable/customer', ['as' => 'customer', 'uses' => 'UserCustomerController@index']);

    Route::resource('user/{client_id}/receivable/customer/create', 'UserCustomerController@create');

    Route::resource('user/{client_id}/receivable/customer/edit', 'UserCustomerController@edit');

    Route::resource('user/{client_id}/receivable/item', 'UserItemsController');

    Route::get('user/{client_id}/receivable/item', ['as' => 'item', 'uses' => 'UserItemsController@index']);

    Route::resource('user/{client_id}/receivable/item/create', 'UserItemsController@create');

    Route::resource('user/{client_id}/receivable/item/edit', 'UserItemsController@edit');

    Route::resource('user/{client_id}/receivable/invoice', 'UserInvoicesController');

    Route::get('user/{client_id}/receivable/invoice', ['as' => 'invoice', 'uses' => 'UserInvoicesController@index']);

    Route::resource('users/cashdisbursement', 'UserCashDisbursementsController');
    Route::resource('user/{client_id}/documents', 'UserDocumentsController');

});




Route::get('/cashdisbursement', function () {
    return view('users.cashdisbursement.index');
});

Route::get('/cashdisbursement/create', function () {
    return view('users.cashdisbursement.create');
});

Route::get('/cashdisbursement/edit', function () {
    return view('users.cashdisbursement.edit');
});

Route::get('/evaluate', function () {
    return view('admin.management.evaluate.index');
});

