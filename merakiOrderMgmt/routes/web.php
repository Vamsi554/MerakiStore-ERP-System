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

// Only Admin Users To Have Access To The Following Links
Route::group(['middleware' => 'admin'], function() {

  // All vendors
  Route::get('/meraki/vendors', 'VendorController@index');
  // Add Vendor
  Route::get('/meraki/vendors/addVendor', 'VendorController@create');
  // Save Vendors
  Route::post('/meraki/vendors/addVendor', 'VendorController@store');
  // Display Vendor
  Route::get('/meraki/vendors/displayVendor/{id}', 'VendorController@show');
  // Edit Vendors
  Route::get('/meraki/vendors/updateVendor/{id}', 'VendorController@edit');
  // Update Existing Vendor
  Route::post('/meraki/vendors/updateVendor/{id}', 'VendorController@update');
  // Delete Existing Vendor
  Route::post('/meraki/vendors/removeVendor/{id}', 'VendorController@destroy');

  // All Users
  Route::get('/meraki/users', 'UserMaintenanceController@index');
  // Add User
  Route::get('/meraki/users/addUser', 'UserMaintenanceController@create');
  // Save Vendors
  Route::post('/meraki/users/addUser', 'UserMaintenanceController@store');
  // Display Vendor
  Route::get('/meraki/users/displayUser/{id}', 'UserMaintenanceController@show');
  // Edit Vendors
  Route::get('/meraki/users/updateUser/{id}', 'UserMaintenanceController@edit');
  // Update Existing Vendor
  Route::post('/meraki/users/updateUser/{id}', 'UserMaintenanceController@update');
  // Delete Existing Vendor
  Route::post('/meraki/users/deleteUser/{id}', 'UserMaintenanceController@destroy');

  // All Product Suite
  Route::get('/productCatalog', 'ProductCatalogController@index');
  // Create New Product
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

  // Manage Orders
  Route::get('/order/manageAdmin', 'AdminOrdersController@manageOrders');
  // Display Admin Order
  Route::get('/order/admin/display/{orderId}/{enquiryId}', 'AdminOrdersController@displayAdminOrder');
  // Create TechPack
  Route::get('/order/admin/techPack/{orderId}/{enquiryId}', 'AdminOrdersController@createTechPack');
  // Save TechPack
  Route::post('/order/admin/techpack/save/{orderId}/{enquiryId}', 'AdminOrdersController@saveTechPack');

  // Purchase Orders
  // Create PO
  Route::get('/order/admin/purchaseOrder/{orderId}/{enquiryId}', 'AdminOrdersController@createPO');
  // Save PO
  Route::post('/order/admin/purchaseOrder/save/{orderId}', 'AdminOrdersController@savePO');
  // Display PO
  Route::get('/order/admin/purchaseOrder/display/{orderId}/{enquiryId}', 'AdminOrdersController@displayPO');
  // Edit PO
  Route::get('/order/admin/purchaseOrder/update/{orderId}/{enquiryId}/{purchaseOrderCode}', 'AdminOrdersController@editPO');
  // Update PO
  Route::post('/order/admin/purchaseOrder/update/{orderId}/{enquiryId}/{purchaseOrderCode}', 'AdminOrdersController@updatePO');

  // Proforma Invoice
  // Save PI
  Route::post('/order/admin/proformaInvoice/save/{orderId}/{enquiryId}', 'AdminOrdersController@saveProforma');
  // Record Customer Payments
  Route::get('/order/admin/paymentReceipt/{orderId}', 'AdminOrdersController@createCustomerPaymentRecord');
  // Save Customer Payments
  Route::post('/order/admin/paymentReceipt/save/{orderId}', 'AdminOrdersController@saveCustomerPaymentRecord');
  // Record Vendor Payments
  Route::get('/order/admin/vendor/paymentReceipt/{orderId}', 'AdminOrdersController@createVendorPaymentRecord');
  // Save Vendor Payments
  Route::post('/order/admin/vendor/paymentReceipt/save/{orderId}', 'AdminOrdersController@saveVendorPaymentRecord');
  // Display Vendor Payments
  Route::get('/order/admin/vendor/paymentReceipt/display/{orderId}', 'AdminOrdersController@getVendorPaymentDetails');

  // Delivery Challan
  // Save DC
  Route::post('/order/admin/deliveryChallan/save/{orderId}/{enquiryId}', 'AdminOrdersController@saveDeliveryChallan');
  // View DC
  Route::get('/order/deliveryChallan/display/{orderId}/{dcCode}', 'AdminOrdersController@viewDeliveryChallan');
  // Invoice
  Route::post('/order/admin/invoice/save/{orderId}/{enquiryId}', 'AdminOrdersController@saveInvoice');


  // Order Status Controller Actions
  // Confirm Order
  Route::post('/order/admin/confirm/{id}', 'OrderStatusController@confirmOrder');
  // Cancel Order
  Route::post('/order/admin/cancel/{id}', 'OrderStatusController@cancelOrder');
  // Hold Order
  Route::post('/order/admin/hold/{id}', 'OrderStatusController@holdOrder');
  // Confirm PI
  Route::post('/order/admin/confirmProformaTechPack/{id}', 'OrderStatusController@confirmProformaTechPack');
  // Request For Advance Payment
  Route::post('/order/admin/reqAdvPayment/{id}', 'OrderStatusController@requestForAdvancePayment');
  // Confirm Advance Payment
  Route::post('/order/admin/reqAdvPayment/confirm/{id}', 'OrderStatusController@confirmAdvancePayment');
  // Confirm Advance Payment Receipt
  Route::post('/order/admin/paymentReceipt/confirm/{id}', 'OrderStatusController@confirmPaymentReceipt');
  // Confirm PO
  Route::post('/order/admin/purchaseOrder/confirm/{id}', 'OrderStatusController@confirmPurchaseOrder');
  // Confirm Order To Production
  Route::post('/order/admin/production/confirm/{id}', 'OrderStatusController@confirmOrderToProduction');
  // Request for Production Samples
  Route::post('/order/admin/production/samples/{id}', 'OrderStatusController@requestForProductionSamples');
  // Request for Revised Production Samples
  Route::post('/order/admin/production/revisedSamples/{id}', 'OrderStatusController@requestForRevisedProductionSamples');
  // Confirm Bulk Printing
  Route::post('/order/admin/production/bulkPrint/confirm/{id}', 'OrderStatusController@proceedWithBulkPrintProduction');
  // Confirm Order Shipment
  Route::post('/order/admin/production/shipment/confirm/{id}', 'OrderStatusController@productionShipmentUnderProgress');
  // Confirm Delivery Challan
  Route::post('/order/admin/deliveryChallan/confirm/{id}', 'OrderStatusController@confirmDeliveryChallan');
  // Confirm Order Delivery
  Route::post('/order/admin/orderDelivery/confirm/{id}', 'OrderStatusController@confirmOrderDelivery');
  // Confirm Tax Invoice
  Route::post('/order/admin/taxInvoice/confirm/{id}', 'OrderStatusController@confirmTaxInvoice');
  // Request For Pending Payment
  Route::post('/order/admin/pendingPayment/request/{id}', 'OrderStatusController@requestOrderPendingPayment');
  // Confirm Full Payment
  Route::post('/order/admin/fullPayment/confirm/{id}', 'OrderStatusController@confirmFullOrderPayment');
  // Confirm Full Payment Receipt
  Route::post('/order/admin/fullPaymentReceipt/confirm/{id}', 'OrderStatusController@confirmFinalPaymentReceipt');
  // Confirm Order Completion
  Route::post('/order/admin/complete/confirm/{id}', 'OrderStatusController@completeOrder');

});

Route::group(['middleware' => 'auth'], function() {

  // No Access Page
  Route::get('/meraki/denyAccess', function() {
    return view('documents.noAccess');
  });

});

Route::group(['middleware' => 'auth', 'admin'], function() {

    // Home Page
    Route::get('/', 'OrderController@userLoginOrder');

    // User Login Enquiry
    Route::get('/enquiry/userLogin', 'EnquiryController@userLoginEnquiry');
    // All Enquiries
    Route::get('/enquiry', 'EnquiryController@index');
    // Approved Enquiries
    Route::get('/enquiry/approved', 'EnquiryController@approvedEnquiry');
    // Hold Enquiries
    Route::get('/enquiry/hold', 'EnquiryController@holdEnquiry');
    // Cancelled Enquiries
    Route::get('/enquiry/cancel', 'EnquiryController@cancelEnquiry');
    // Enquiries - Awaiting Quotation
    Route::get('/enquiry/quotation', 'EnquiryController@awaitQuoteEnquiry');
    // Create New Enquiry
    Route::get('/enquiry/createEnquiry', 'EnquiryController@create');
    // Display Existing Enquiry
    Route::get('/enquiry/displayEnquiry/{id}', 'EnquiryController@show');
    // Enquiry Quotation
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


    // User Login Orders
    Route::get('/order/userLogin', 'OrderController@userLoginOrder');
    // Hold Orders
    Route::get('/order/hold', 'OrderController@holdOrder');
    // Cancel Orders
    Route::get('/order/cancel', 'OrderController@cancelOrder');
    // All Orders
    Route::get('/order', 'OrderController@index');
    // Create New Order
    Route::get('/order/createOrder/{enquiryId}/{quoteId}', 'OrderController@create');
    // Display Existing Order
    Route::get('/order/displayOrder/{id}', 'OrderController@show');
    // Add New Order
    Route::post('/order/addOrder/{enquiryId}/{quoteId}', 'OrderController@store');
    // Edit Order
    Route::get('/order/updateOrder/{id}', 'OrderController@edit');
    // Update Orders
    Route::post('/order/updateOrder/{id}', 'OrderController@update');
    // Order Status Updates
    Route::post('/order/statusUpdate/save/{id}', 'OrderStatusController@addStatusUpdate');
    // Display PI
    Route::get('/order/proformaInvoice/display/{orderId}/{enquiryId}', 'AdminOrdersController@viewProforma');
    // Display Customer Payments
    Route::get('/order/paymentReceipt/display/{orderId}/{customerPaymentCd}', 'AdminOrdersController@getCustomerPaymentReceipt');
    // Lifecycle
    Route::get('/order/lifecycle/{orderId}/{enquiryId}', 'EnquiryController@getLifecycle');
    // Order Invoice Screen
    Route::get('/order/invoice/display/{orderId}/{enquiryId}', 'AdminOrdersController@viewInvoice');
    // Payment Receipt
    Route::get('/order/paymentReceipt/{id}', 'OrderController@generatePaymentReceipt');
    // Proforma Invoice
    Route::get('/order/proformaInvoice/{id}', 'OrderController@generateProformaInvoice');
    // Delivery Challan
    Route::get('/order/deliveryChallan/{id}', 'OrderController@generateDeliveryChallan');
    // Get Product Details
    Route::get('/productDetails/{id}', 'EnquiryController@getProductDetails');
    // Get Tech Pack
    Route::get('/order/techPack/display/{orderId}/{enquiryId}', 'AdminOrdersController@viewTechPack');

    Route::get('logout', function (){
        Auth::logout();
        return redirect('/');
    });

    Route::get('/meraki/userNotifications/markAllRead', 'UserMaintenanceController@massReadNotifications');

    Route::get('/meraki/userTasks/markAllRead', 'TaskManagementController@massReadTasks');

    Route::get('/meraki/tasks/assign', 'UserMaintenanceController@assignTask');

    Route::get('/meraki/orders/invoice/pdf', 'HomeController@generatePDF');

    // All Tasks
    Route::get('/meraki/tasks', 'TaskManagementController@index');

    Route::get('/meraki/tasks/open', 'TaskManagementController@openTasks');

    Route::get('/meraki/tasks/completed', 'TaskManagementController@closedTasks');

    Route::get('/meraki/tasks/addTask', 'TaskManagementController@create');

    Route::post('/meraki/tasks/addTask', 'TaskManagementController@store');

    Route::get('/meraki/tasks/displayTask/{id}', 'TaskManagementController@show');

    Route::get('/meraki/tasks/updateTask/{id}', 'TaskManagementController@edit');

    Route::post('/meraki/tasks/updateTask/{id}', 'TaskManagementController@update');

    Route::post('/meraki/tasks/addNote/save/{id}', 'TaskManagementController@addNoteOnTask');

    Route::post('/meraki/tasks/submit/approval/{id}', 'TaskManagementController@submitTaskForApproval');

    Route::post('/meraki/tasks/completeTask/{id}', 'TaskManagementController@completeTask');

    Route::get('/productCatalog', 'ProductCatalogController@index');
    // Display Existing Product
    Route::get('/productCatalog/displayProduct/{id}', 'ProductCatalogController@show');

    Route::get('/customers/orders/track', 'AnalyticsController@index');

    Route::get('/leadSource/track', 'AnalyticsController@trackLeadSource');

    Route::get('/jsonData/get', 'AnalyticsController@testJsonData');

    Route::get('/leadSource/jsonData/get', 'AnalyticsController@testLeadSourceJsonData');
});
