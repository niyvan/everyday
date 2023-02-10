<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\DefaultController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\StockController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;

Route::get('/', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');



 Route::middleware('auth')->group(function(){



 // Admin All Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');

});

// Category All Route
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('category.all');
    Route::get('/categories/create', 'create')->name('category.add');
    Route::post('/categories', 'store')->name('category.store');
    Route::get('/categories/{id}/edit', 'edit')->name('category.edit');
    Route::post('/categories/update', 'update')->name('category.update');
    Route::get('/categories/{id}', 'destroy')->name('category.delete');

});

// Product All Route
Route::controller(ProductController::class)->group(function () {
    Route::get('/items', 'index')->name('item.index');
    Route::get('/items/create', 'create')->name('item.create');
    Route::post('/items', 'store')->name('item.store');
    Route::get('/items/{id}/edit', 'edit')->name('item.edit');
    Route::post('/items/update', 'update')->name('item.update');
    Route::get('/items/{id}', 'destroy')->name('item.destroy');

});

// Customer All Route
Route::controller(CustomerController::class)->group(function () {
    Route::get('/customers', 'index')->name('customer.all');
    Route::get('/customers/create', 'create')->name('customer.add');
    Route::post('/customers', 'store')->name('customer.store');
    Route::get('/customers/{id}/edit', 'edit')->name('customer.edit');
    Route::post('/customers/update', 'update')->name('customer.update');
    Route::get('/customers/{id}', 'destroy')->name('customer.delete');

    Route::get('/credit/customers', 'credit')->name('credit.customer');
    Route::get('/credit/customers/print/pdf', 'creditPrintPdf')->name('credit.customer.print.pdf');

    Route::get('/customers/edit/invoice/{invoice_id}', 'editInvoice')->name('customer.edit.invoice');
     Route::post('/customers/update/invoice/{invoice_id}', 'UpdateInvoice')->name('customer.update.invoice');

     Route::get('/customers/invoice/details/{invoice_id}', 'invoiceDetails')->name('customer.invoice.details.pdf');

      Route::get('/paid/customers', 'paid')->name('paid.customer');
      Route::get('/paid/customers/print/pdf', 'paidPrintPdf')->name('paid.customer.print.pdf');

       Route::get('/customers/wise/report', 'wiseReport')->name('customer.wise.report');
       Route::get('/customers/wise/credit/report', 'wiseCreditReport')->name('customer.wise.credit.report');
       Route::get('/customers/wise/paid/report', 'wisePaidReport')->name('customer.wise.paid.report');

});



// Purchase All Route
Route::controller(PurchaseController::class)->group(function () {
    Route::get('/purchase/all', 'PurchaseAll')->name('purchase.all');
    Route::get('/purchase/add', 'PurchaseAdd')->name('purchase.add');
    Route::post('/purchase/store', 'PurchaseStore')->name('purchase.store');
    Route::get('/purchase/edit/{id}', 'PurchaseEdit')->name('purchase.edit');
    Route::post('/purchase/update', 'PurchaseUpdate')->name('purchase.update');
    Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('purchase.delete');
    Route::get('/purchase/pending', 'PurchasePending')->name('purchase.pending');
    Route::get('/purchase/approve/{id}', 'PurchaseApprove')->name('purchase.approve');

    Route::get('/daily/purchase/report', 'DailyPurchaseReport')->name('daily.purchase.report');
    Route::get('/daily/purchase/pdf', 'DailyPurchasePdf')->name('daily.purchase.pdf');

});


// Invoice All Route
Route::controller(InvoiceController::class)->group(function () {
    Route::get('/invoices', 'index')->name('invoice.index');
    Route::get('/invoices/create', 'create')->name('invoice.create');
    Route::post('/invoices', 'store')->name('invoice.store');
    Route::get('/invoice/pending/list', 'pendingList')->name('invoice.pending.list');
    Route::get('/invoice/{id}', 'destroy')->name('invoice.destroy');
    Route::get('/invoice/approve/{id}', 'approve')->name('invoice.approve');
    Route::post('/approval/store/{id}', 'approvalStore')->name('approval.store');
    Route::get('/invoice/cancel/{id}', 'cancel')->name('invoice.cancel');
    Route::post('/cancelled/invoice/{id}', 'cancelInvoice')->name('cancelled.invoice');
    Route::get('/print/invoice/{id}', 'print')->name('print.invoice');

    Route::get('/daily/invoice/report', 'dailyReport')->name('daily.invoice.report');
    Route::get('/daily/invoice/pdf', 'dailyPdf')->name('daily.invoice.pdf');


});





// Stock All Route
Route::controller(StockController::class)->group(function () {
    Route::get('/stock/report', 'StockReport')->name('stock.report');
    Route::get('/stock/report/pdf', 'StockReportPdf')->name('stock.report.pdf');

    Route::get('/stock/product/wise', 'StockProductWise')->name('stock.product.wise');
    Route::get('/product/wise/pdf', 'ProductWisePdf')->name('product.wise.pdf');


});



 }); // End Group Middleware




// Default All Route
Route::controller(DefaultController::class)->group(function () {
    Route::get('/get-category', 'GetCategory')->name('get-category');
    Route::get('/get-product', 'GetProduct')->name('get-product');
    Route::get('/check-product', 'GetStock')->name('check-product-stock');

});


Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
