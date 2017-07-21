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

});

	/*Route::get('user/client/{client_id}/payable/vendor', function($client_id){

		$client_id = App\Client
		return view (users.payable.vendor);
	});*/


Route::group(['middleware'=>'auth'], function(){

	Route::resource('admin/lists/vat', 'AdminVatsController');

	Route::resource('user/accounting/vat', 'UserVatsController');

	Route::resource('user/{client_id}/payable/vendor', 'UserVendorController');

	Route::resource('user/{client_id}/accounting/coa', 'UserCoasController');

});

Route::get('/log', function () {
    return view('admin.logs.index');
});

Route::get('/log/create', function () {
    return view('admin.logs.create');
});

Route::get('/log/edit', function () {
    return view('admin.logs.edit');
});

Route::get('/client_assign', function () {
    return view('admin.manages.assign.index');
});

Route::get('/task', function () {
    return view('admin.manages.task.index');
});

Route::get('/manage', function () {
    return view('admin.manages.index');
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
    return view('admin.manages.index');
});

Route::get('/item', function () {
    return view('admin.manages.index');
});

Route::get('/item/create', function () {
    return view('admin.manages.index');
});

Route::get('/item/edit', function () {
    return view('admin.manages.index');
});

Route::get('/customer', function () {
    return view('admin.manages.index');
});

Route::get('/customer/create', function () {
    return view('admin.manages.index');
});

Route::get('/customer/edit', function () {
    return view('admin.manages.index');
});

Route::get('/cashdisbursement', function () {
    return view('admin.manages.index');
});

