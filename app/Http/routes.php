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
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/admin', function(){

	return view ('admin.index');
});


Route::group(['middleware'=>'admin'], function(){

	Route::resource('admin/users', 'AdminUsersController');

	Route::resource('admin/clients', 'AdminClientsController');

	Route::resource('admin/lists/business', 'AdminBusinessesController');

	Route::resource('admin/lists/coa', 'AdminCoasController');

    Route::resource('admin/management/logs', 'AdminLogsController');

    Route::resource('admin/management/assign', 'AdminClientUserController');

    Route::resource('admin/management/task', 'AdminTasksController');

});

	/*Route::get('user/client/{client_id}/payable/vendor', function($client_id){

		$client_id = App\Client
		return view (users.payable.vendor);
	});*/


Route::group(['middleware'=>'auth'], function(){

	Route::resource('admin/lists/vat', 'AdminVatsController');

	Route::resource('user/accounting/vat', 'UserVatsController');

    Route::resource('user/accounting/transaction', 'UserTransactionsController');

	Route::resource('user/{client_id}/payable/vendor', 'UserVendorController');

	Route::resource('user/{client_id}/payable/vendor/create', 'UserVendorController@create');

    Route::resource('user/{client_id}/payable/vendor/edit', 'UserVendorController@edit');

    Route::resource('user/{client_id}/receivable/customer', 'UserCustomerController');

    Route::resource('user/{client_id}/receivable/customer/create', 'UserCustomerController@create');

    Route::resource('user/{client_id}/receivable/customer/edit', 'UserCustomerController@edit');
    

	Route::resource('user/{client_id}/accounting/coa', 'UserCoasController');

    Route::resource('users/cashdisbursement', 'UserCashDisbursementsController');

});





Route::get('/journal', function () {
    return view('users.accounting.journal.index');
});

Route::get('/journal/create', function () {
    return view('users.accounting.journal.create');
});

Route::get('/journal/edit', function () {
    return view('users.accounting.journal.edit');
});

Route::get('/bill', function () {
    return view('users.payable.bill.index');
});

Route::get('/bill/create', function () {
    return view('users.payable.bill.create');
});

Route::get('/bill/edit', function () {
    return view('users.payable.bill.edit');
});

Route::get('/invoice', function () {
    return view('users.receivable.invoice.index');
});

Route::get('/invoice/create', function () {
    return view('users.receivable.invoice.create');
});

Route::get('/invoice/edit', function () {
    return view('users.receivable.invoice.edit');
});

Route::get('/item', function () {
    return view('users.receivable.item.index');
});

Route::get('/item/create', function () {
    return view('users.receivable.item.create');
});

Route::get('/item/edit', function () {
    return view('users.receivable.item.edit');
});

Route::get('/customer', function () {
    return view('users.receivable.customer.index');
});

Route::get('/customer/create', function () {
    return view('users.receivable.customer.create');
});

Route::get('/customer/edit', function () {
    return view('users.receivable.customer.edit');
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

Route::get('/usertask', function () {
    return view('users.other.index');
});
