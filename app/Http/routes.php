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

    Route::resource('admin/manage/logs', 'AdminLogsController');

    Route::resource('admin/manage/assignclient', 'AdminClientUserController');

    Route::resource('admin/manage/task', 'AdminTasksController');

});

	/*Route::get('user/client/{client_id}/payable/vendor', function($client_id){

		$client_id = App\Client
		return view (users.payable.vendor);
	});*/


Route::group(['middleware'=>'auth'], function(){

	Route::resource('admin/lists/vat', 'AdminVatsController');

	Route::resource('user/accounting/vat', 'UserVatsController');

	Route::resource('user/{client_id}/payable/vendor', 'UserVendorController');

	Route::resource('user/{client_id}/payable/vendor', 'UserVendorController@store');

	Route::resource('user/{client_id}/accounting/coa', 'UserCoasController');

});




Route::get('/task', function () {
    return view('admin.management.task.index');
});

Route::get('/manage', function () {
    return view('admin.management.index');
});

Route::get('/transaction', function () {
    return view('users.accounting.transaction.index');
});

Route::get('/transaction/create', function () {
    return view('users.accounting.transaction.create');
});

Route::get('/transaction/edit', function () {
    return view('users.accounting.transaction.edit');
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
