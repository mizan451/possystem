<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'=>'auth'], function(){

    Route::prefix('users')->group(function(){
    Route::get('/view', 'Backend\UserController@view')->name('users.view');
    Route::get('/add', 'Backend\UserController@add')->name('users.add');
    Route::post('/store', 'Backend\UserController@store')->name('users.store');
    Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
    Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
    Route::get('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');
});


Route::prefix('profile')->group(function(){
Route::get('/view', 'Backend\profileController@view')->name('profile.view');
Route::get('/edit', 'Backend\profileController@edit')->name('profile.edit');
Route::post('/update', 'Backend\profileController@update')->name('profile.update');
Route::get('/password/view', 'Backend\profileController@passwordView')->name('profile.password.view');
Route::post('/password/update', 'Backend\profileController@passwordUpdate')->name('profile.password.update');

});


 Route::prefix('supliers')->group(function(){
    Route::get('/view', 'Backend\SuplierController@view')->name('supliers.view');
    Route::get('/add', 'Backend\SuplierController@add')->name('supliers.add');
    Route::post('/store', 'Backend\SuplierController@store')->name('supliers.store');
    Route::get('/edit/{id}', 'Backend\SuplierController@edit')->name('supliers.edit');
    Route::post('/update/{id}', 'Backend\SuplierController@update')->name('supliers.update');
    Route::get('/delete/{id}', 'Backend\SuplierController@delete')->name('supliers.delete');
});

  Route::prefix('customers')->group(function(){
    Route::get('/view', 'Backend\CustomerController@view')->name('customers.view');
    Route::get('/add', 'Backend\CustomerController@add')->name('customers.add');
    Route::post('/store', 'Backend\CustomerController@store')->name('customers.store');
    Route::get('/edit/{id}', 'Backend\CustomerController@edit')->name('customers.edit');
    Route::post('/update/{id}', 'Backend\CustomerController@update')->name('customers.update');
    Route::get('/delete/{id}', 'Backend\CustomerController@delete')->name('customers.delete');
    Route::get('/credit', 'Backend\CustomerController@creditCustomer')->name('customers.credit');
    Route::get('/credit/pdf', 'Backend\CustomerController@creditCustomerPdf')->name('customers.credit.pdf');
    Route::get('/invoice/edit/{invoice_id}','Backend\CustomerController@editInvoice')->name('customers.edit.invoice');
    Route::post('/invoice/update/{invoice_id}','Backend\CustomerController@updateInvoice')->name('customers.update.invoice');
    Route::get('/invoice/details/pdf/{invoice_id}','Backend\CustomerController@invoiceDetailsPdf')->name('invoice.details.pdf');

    Route::get('/paid', 'Backend\CustomerController@paidCustomer')->name('customers.paid');
    Route::get('/paid/pdf', 'Backend\CustomerController@paidCustomerPdf')->name('customers.paid.pdf');
    Route::get('/wise/report', 'Backend\CustomerController@customerWiseReport')->name('customers.wise.report');

    Route::get('/wise/credit/report', 'Backend\CustomerController@customerWiseCredit')->name('customers.wise.credit.report');
    Route::get('/wise/paid/report', 'Backend\CustomerController@customerWisePaid')->name('customers.wise.report');
});

  Route::prefix('units')->group(function(){
    Route::get('/view', 'Backend\unitController@view')->name('units.view');
    Route::get('/add', 'Backend\unitController@add')->name('units.add');
    Route::post('/store', 'Backend\unitController@store')->name('units.store');
    Route::get('/edit/{id}', 'Backend\unitController@edit')->name('units.edit');
    Route::post('/update/{id}', 'Backend\unitController@update')->name('units.update');
    Route::get('/delete/{id}', 'Backend\unitController@delete')->name('units.delete');
});


  Route::prefix('categories')->group(function(){
    Route::get('/view', 'Backend\CategoryController@view')->name('categories.view');
    Route::get('/add', 'Backend\CategoryController@add')->name('categories.add');
    Route::post('/store', 'Backend\CategoryController@store')->name('categories.store');
    Route::get('/edit/{id}', 'Backend\CategoryController@edit')->name('categories.edit');
    Route::post('/update/{id}', 'Backend\CategoryController@update')->name('categories.update');
    Route::get('/delete/{id}', 'Backend\CategoryController@delete')->name('categories.delete');
});

Route::prefix('products')->group(function(){
    Route::get('/view', 'Backend\ProductController@view')->name('products.view');
    Route::get('/add', 'Backend\ProductController@add')->name('products.add');
    Route::post('/store', 'Backend\ProductController@store')->name('products.store');
    Route::get('/edit/{id}', 'Backend\ProductController@edit')->name('products.edit');
    Route::post('/update/{id}', 'Backend\ProductController@update')->name('products.update');
    Route::get('/delete/{id}', 'Backend\ProductController@delete')->name('products.delete');
});

Route::prefix('purchase')->group(function(){
    Route::get('/view', 'Backend\PurchaseController@view')->name('purchase.view');
    Route::get('/add', 'Backend\PurchaseController@add')->name('purchase.add');
    Route::post('/store', 'Backend\PurchaseController@store')->name('purchase.store');
    Route::get('/pending/', 'Backend\PurchaseController@pendingList')->name('purchase.pending.list');
    Route::get('/approve/{id}', 'Backend\PurchaseController@approve')->name('purchase.approve');
    Route::get('/delete/{id}', 'Backend\PurchaseController@delete')->name('purchase.delete');

    Route::get('/report', 'Backend\PurchaseController@purchaseReport')->name('purchase.report');
    Route::get('/report/pdf', 'Backend\PurchaseController@purchaseReportPdf')->name('purchase.report.pdf');
    
});


 Route::get('/get-category', 'Backend\defaultController@getCategory')->name('get-category');
  Route::get('/get-product', 'Backend\defaultController@getProduct')->name('get-product');
   Route::get('/get-stock', 'Backend\defaultController@getStock')->name('check-product-stock');

Route::prefix('invoice')->group(function(){
    Route::get('/view', 'Backend\InvoiceController@view')->name('invoice.view');
    Route::get('/add', 'Backend\InvoiceController@add')->name('invoice.add');
    Route::post('/store', 'Backend\InvoiceController@store')->name('invoice.store');
    Route::get('/pending/', 'Backend\InvoiceController@pendingList')->name('invoice.pending.list');
    Route::get('/approve/{id}', 'Backend\InvoiceController@approve')->name('invoice.approve');
    Route::get('/delete/{id}', 'Backend\InvoiceController@delete')->name('invoice.delete'); 
    Route::post('/approve/store/{id}', 'Backend\InvoiceController@approvalStore')->name('approval.store');
    
    Route::get('/print/list', 'Backend\InvoiceController@printInvoiceList')->name('invoice.print.list');
    Route::get('/print/{id}', 'Backend\InvoiceController@printInvoice')->name('invoice.print');
    Route::get('/daily/report', 'Backend\InvoiceController@dailyReport')->name('invoice.daily.report');
     Route::get('/daily/report/pdf', 'Backend\InvoiceController@dailyReportPdf')->name('invoice.daily.report.pdf');

  });
Route::prefix('stock')->group(function(){
    Route::get('/report', 'Backend\StockController@stockReport')->name('stock.report');
    Route::get('/report/pdf', 'Backend\StockController@stockReportPdf')->name('stock.report.pdf');
    Route::get('/report/suplier/product/wise', 'Backend\StockController@supliedProductWise')->name('stock.report.suplier.product.wise');

    Route::get('/report/suplier/wise/pdf', 'Backend\StockController@supliedWisePdf')->name('stock.report.suplier.wise.pdf');

      Route::get('/report/product/wise/pdf', 'Backend\StockController@productWisePdf')->name('stock.report.product.wise.pdf');

  });

});




