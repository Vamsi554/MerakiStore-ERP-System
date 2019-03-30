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


Auth::routes();

Route::get('/vk/proforma/{id}', function($id) {
  return view('proformaInvoice', compact('id'));
});

Route::get('/vk/deliveryChallan/{id}', function($id) {
  return view('deliveryChallan', compact('id'));
});

Route::get('/vk/{id}', function($id) {
  return view('quotationDouble', compact('id'));
});

Route::get('/mvk/{id}', function($id) {
  return view('quotationMultiple', compact('id'));
});

Route::get('/testInvoice/{id}', function($id) {

  $orderCycle = App\OrderCycle::where('enquiry_id', $id)->orderBy('id','desc')->get();
  return view('orderTimeLine', compact('orderCycle'));
});

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', 'EnquiryController@index');

    // All Product Suite
    Route::get('/productCatalog', 'ProductCatalogController@index');
    // Create New Enquiry
    Route::get('/productCatalog/createProduct', 'ProductCatalogController@create');
    // Add New Product
    Route::post('/productCatalog/addProduct', 'ProductCatalogController@store');
    // Display Existing Product
    Route::get('/productCatalog/displayProduct/{id}', 'ProductCatalogController@show');
    // Edit Existing Product
    Route::get('/productCatalog/updateProduct/{id}', 'ProductCatalogController@edit');
    // Update Existing Product
    Route::post('/productCatalog/updateProduct/{id}', 'ProductCatalogController@update');
    // Delete Existing Product
    Route::post('/productCatalog/removeProduct/{id}', 'ProductCatalogController@destroy');

    // All Enquiries
    Route::get('/enquiry', 'EnquiryController@index');
    // Create New Enquiry
    Route::get('/enquiry/createEnquiry', 'EnquiryController@create');
    // Display Existing Enquiry
    Route::get('/enquiry/displayEnquiry/{id}', 'EnquiryController@show');
    // Display Existing Enquiry
    Route::get('/enquiry/generateQuote/{id}', 'EnquiryController@quote');
    // Add New Enquiry
    Route::post('/enquiry/addEnquiry', 'EnquiryController@store');
    // Edit Enquiry
    Route::get('/enquiry/updateEnquiry/{id}', 'EnquiryController@edit');
    // Update Enquiry
    Route::post('/enquiry/updateEnquiry/{id}', 'EnquiryController@update');
    // Save Quotation
    Route::post('/enquiry/saveQuotation/{id}', 'EnquiryController@saveQuote');
    // View Quotation
    Route::get('/enquiry/quotation/{id}/{quoteCd}', 'EnquiryController@viewQuote');


    // All Orders
    Route::get('/order', 'OrderController@index');
    // Create New Order
    Route::get('/order/createOrder/{enquiryId}/{quoteId}', 'OrderController@create');
    // Display Existing Order
    Route::get('/order/displayOrder/{id}', 'OrderController@show');
    // Add New Order
    Route::post('/order/addOrder', 'OrderController@store');
    // Edit Order
    Route::get('/order/updateOrder/{id}', 'OrderController@edit');
    // Update Orders
    Route::post('/order/updateOrder/{id}', 'OrderController@update');


    // Order Invoice Screen
    Route::get('/order/invoice/{id}', 'OrderController@generateInvoice');

    // Order Quotations Screen
    Route::get('/order/quotation/{id}', 'OrderController@generateQuotation');

    Route::get('/order/proformaInvoice/{id}', 'OrderController@generateProformaInvoice');

    Route::get('/order/invoice/print/{id}', 'HomeController@pdfInvoice');

    Route::get('/productDetails/{id}', 'EnquiryController@getProductDetails');

    Route::get('logout', function (){
        Auth::logout();
        return redirect('/');
    });
});
