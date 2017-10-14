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

Route::get('/home', function(){

    return view ('admin.index');
});




Route::group(['middleware'=>'admin'], function(){


	Route::resource('admin/utilities/users', 'AdminUsersController');

    Route::resource('admin/utilities/closing', 'AdminClosingController');

    Route::resource('admin/utilities/activity', 'AdminActivityController');

	Route::resource('admin/clients', 'AdminClientsController');

	Route::resource('admin/lists/coa', 'AdminCoasController');

    Route::resource('admin/lists/vat', 'AdminVatsController');

    Route::resource('admin/lists/business', 'AdminBusinessesController');

    Route::resource('admin/lists/document', 'AdminDocumentController');



});

Route::group(['middleware'=>'manager'], function(){

    Route::resource('admin/management/assign', 'AdminClientUserController');

    Route::resource('admin/management/team', 'AdminTeamsController');

    Route::resource('admin/management/myteam', 'AdminTeamsController');

    Route::resource('admin/management/logs', 'AdminLogsController');

    Route::resource('admin/management/task', 'AdminTasksController');

    //Ajax
    Route::get('admin/management/task/create/findClient/{client_id?}','AdminTasksController@findClient');

    Route::get('admin/management/task/{task_id}/edit/findClient/{client_id?}','AdminTasksController@findClient');

    Route::get('admin/management/task/create/findDocument/{client_id?}','AdminTasksController@findDocument');

    Route::get('admin/management/task/{task_id}/edit/findDocument/{client_id?}','AdminTasksController@findDocument');

    Route::get('admin/management/evaluation', 'UserReportsController@employee_evaluation_index');
    
    Route::get('admin/management/evaluation/generate', 'UserReportsController@employee_evaluation_generate');

});

Route::group(['middleware'=>'auth'], function(){

    Route::get('user/profile', 'UserHomeController@profile');

    Route::resource('user/tasks', 'UserTasksController');

    Route::resource('user/accounting/vat', 'UserVatsController');

});

Route::group(['middleware'=>'user'], function(){

    Route::resource('user/{client_id}/home', 'UserHomeController');


    Route::resource('user/{client_id}/accounting/transaction', 'UserTransactionsController');

    //Journal

    Route::resource('user/{client_id}/accounting/journal', 'UserJournalsController');

    Route::resource('user/{client_id}/accounting/journal/create', 'UserJournalsController@create');

    Route::get('user/{client_id}/accounting/journal', ['as' => 'journal', 'uses' => 'UserJournalsController@index']);

    Route::resource('user/{client_id}/accounting/journal/edit', 'UserJournalsController@edit');

    Route::post('user/{client_id}/accounting/journal', array('as'=>'insertjournal','uses'=>'UserJournalsController@store'));

    Route::get('user/{client_id}/accounting/journal/{journal_id}/show',array('as'=>'journalpdfview','uses'=>'UserJournalsController@show'));

    //Adjusting

    Route::resource('user/{client_id}/adjusting', 'UserAdjustingController');

    Route::resource('user/{client_id}/adjusting/create', 'UserAdjustingController@create');

    Route::get('user/{client_id}/accounting/adjusting', ['as' => 'adjusting', 'uses' => 'UserAdjustingController@index']);

    Route::resource('user/{client_id}/adjusting/edit', 'UserAdjustingController@edit');

    Route::post('user/{client_id}/adjusting', array('as'=>'insertadjusting','uses'=>'UserAdjustingController@store'));

    //COA

    Route::resource('user/{client_id}/accounting/coa', 'UserCoasController');

    Route::resource('user/{client_id}/accounting/coa/create', 'UserCoasController@create');

    //Route::resource('user/{client_id}/accounting/coa/edit', 'UserCoasController@edit');

    Route::get('user/{client_id}/accounting/coa', ['as' => 'coa', 'uses' => 'UserCoasController@index']);

    //Vendor

	Route::resource('user/{client_id}/payable/vendor', 'UserVendorController');

    Route::get('user/{client_id}/payable/vendor', ['as' => 'vendor', 'uses' => 'UserVendorController@index']);

	Route::resource('user/{client_id}/payable/vendor/create', 'UserVendorController@create');

    Route::resource('user/{client_id}/payable/vendor/edit', 'UserVendorController@edit');

    //Bill


    Route::resource('user/{client_id}/payable/bill', 'UserBillsController');

    Route::resource('user/{client_id}/payable/cb', 'UserBillsController');

    Route::post('user/{client_id}/payable/cb', array('as'=>'insertcb','uses'=>'UserBillsController@cbstore'));

    Route::get('user/{client_id}/payable/bill', ['as' => 'bill', 'uses' => 'UserBillsController@index']);

    Route::resource('user/{client_id}/payable/bill/create', 'UserBillsController@create');

    Route::get('user/{client_id}/payable/bill/create/findPrice/{item_id?}','UserBillsController@findPrice');

    Route::resource('user/{client_id}/payable/bill/edit', 'UserBillsController@edit');

    Route::get('user/{client_id}/payable/bill/{bill_id}/edit/findPrice/{item_id?}','UserBillsController@findPrice');

    Route::resource('user/{client_id}/payable/bill/pay', 'UserBillsController@pay');

    Route::get('user/{client_id}/payable/bill/pay', 'UserBillsController@pay');

    Route::post('user/{client_id}/payable/bill', array('as'=>'insertbill','uses'=>'UserBillsController@store'));

    Route::get('user/{client_id}/payable/bill/{bill_id}/show',array('as'=>'billpdfview','uses'=>'UserBillsController@show'));

   // Route::get('user/{client_id}/payable/bill/edit', 'UserBillsController@update');

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

    Route::resource('user/{client_id}/receivable/invoice/create', 'UserInvoicesController@create');

    Route::get('user/{client_id}/receivable/invoice/create/findPrice/{item_id?}','UserInvoicesController@findPrice');

    Route::get('user/{client_id}/receivable/invoice/{invoice_id}/edit/findPrice/{item_id?}','UserInvoicesController@findPrice');

    Route::resource('user/{client_id}/receivable/invoice/edit', 'UserInvoicesController@edit');

    Route::resource('user/{client_id}/receivable/invoice/pay', 'UserInvoicesController@pay');

    Route::get('user/{client_id}/receivable/invoice/pay', 'UserInvoicesController@pay');

    Route::post('user/{client_id}/receivable/invoice', array('as'=>'insertinvoice','uses'=>'UserInvoicesController@store'));

    Route::get('user/{client_id}/receivable/invoice/{invoice_id}/show',array('as'=>'invoicepdfview','uses'=>'UserInvoicesController@show'));

    Route::resource('user/{client_id}/documents', 'UserDocumentsController');


    Route::resource('user/{client_id}/reports/audit', 'UserAuditController');

    //REPORTS

    Route::get('user/{client_id}/reports/trialbalance/{end}', 'UserReportsController@trial_balance_index');

    Route::get('user/{client_id}/reports/trialbalance/generate', 'UserReportsController@trial_balance_generate');

    Route::get('user/{client_id}/reports/generalledger/{start}/{end}', 'UserReportsController@general_ledger_index');
    
    Route::get('user/{client_id}/reports/generalledger/generate', 'UserReportsController@general_ledger_generate');

    Route::get('user/{client_id}/reports/balancesheet/{end}', 'UserReportsController@balance_sheet_index');
    
    Route::get('user/{client_id}/reports/balancesheet/generate', 'UserReportsController@balance_sheet_generate');

    Route::get('user/{client_id}/reports/profitandloss', 'UserReportsController@profit_and_loss_index');
    
    Route::get('user/{client_id}/reports/profitandloss/generate', 'UserReportsController@profit_and_loss_generate');

});

