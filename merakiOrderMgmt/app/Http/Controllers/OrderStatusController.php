<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderStatusUpdates;
use App\OrderCycle;
use App\Enquiry;

use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\UserActions;
use App\Notifications\UserTasks;


class OrderStatusController extends Controller
{

    public function addStatusUpdate(Request $request, $id) {

        $order = Order::find($id);
        $enquiryId = $order->enquiry_id;
        $documentNumber = $order->documentNumber;
        $orderStatus = $order->orderStatus;
        $statusDescr = $request->orderStatusUpdate;
        OrderStatusUpdates::addStatusUpdate($id, $enquiryId, $documentNumber, $orderStatus, $statusDescr);

        $subjectLine = "Mr. " . \Auth::user()->name . " Added Status Update.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);
        return back()->with('success', 'Order Status Update Added Successfully');
    }

    public function confirmOrder(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "ORDER CONFIRMED";
        $order->save();

        $enquiry = Enquiry::find($order->enquiry_id);
        $enquiry->enquiryStatus = "APPROVED";
        $enquiry->save();

        $subjectLine = "Order Confirmed";
        $content = "Mr. " . \Auth::user()->name . " Reviewed the Order Details and Confirmed the Order";
        $linkDescr = "View Order";
        $link = "/order/displayOrder/" . $id;
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, $linkDescr, $link, null, "ORDER CONFIRMED");

        $subjectLine = "Mr. " . \Auth::user()->name . " confirmed the Order.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Order Confirmed Successfully');
    }

    public function cancelOrder(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "ORDER CANCELLED";
        $order->save();

        $enquiry = Enquiry::find($order->enquiry_id);
        $enquiry->enquiryStatus = "CANCEL";
        $enquiry->save();

        $subjectLine = "Order Cancelled";
        $content = "Mr. " . \Auth::user()->name . " Cancelled the Order";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, null, "ORDER CANCELLED");

        $subjectLine = "Mr. " . \Auth::user()->name . " cancelled the Order.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Order Cancelled Successfully');
    }

    public function holdOrder(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "ORDER ON HOLD";
        $order->save();

        $enquiry = Enquiry::find($order->enquiry_id);
        $enquiry->enquiryStatus = "ON HOLD";
        $enquiry->save();


        $subjectLine = "Order On Hold";
        $content = "Mr. " . \Auth::user()->name . " Has Put The Order On Hold As Customer Is Not Ready To Confirm The Order";
        $linkDescr = "View Order";
        $link = "/order/displayOrder/" . $id;
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, $linkDescr, $link, null, "ORDER ON HOLD");

        $subjectLine = "Mr. " . \Auth::user()->name . " Put the Order On Hold.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Order On Hold');
    }

    public function confirmProformaTechPack(Request $request, $id) {

        $order = Order::find($id);
        if($order->proformaInvoiceNumber != '///////////////' && $order->techPackNumber != '///////////////') {
            $order->orderStatus = "PROFORMA INVOICE & TECH PACK GENERATED";
            $order->save();

            $subjectLine = "Tech Pack Generated";
            $content = "Mr. " . \Auth::user()->name . " Has Generated The Tech Pack For The Order";
            $linkDescr = "View Tech Pack";
            $link = "/order/techPack/display/" . $id . "/" . $order->enquiry_id;
            OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, $linkDescr, $link, null, "PROFORMA INVOICE & TECH PACK GENERATED");

            $subjectLine = "Proforma Invoice Generated";
            $content = "Mr. " . \Auth::user()->name . " Has Generated The Proforma Invoice For The Order";
            $linkDescr = "View Proforma Invoice";
            $link = "/order/proformaInvoice/display/" . $id . "/" . $order->enquiry_id;
            OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, $linkDescr, $link, null, "PROFORMA INVOICE & TECH PACK GENERATED");

            $subjectLine = "Mr. " . \Auth::user()->name . " confirmed the Proforma Invoice & Tech Pack for the Order.";
            $link = "/order/displayOrder/" . $order->id;
            Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

            return back()->with('success', 'Proforma Invoice & Tech Pack Generated Successfully');
        }
        else if($order->proformaInvoiceNumber == '///////////////') {
            return back()->with('error', 'Please Generate the Proforma Invoice for the Order');
        }
        else {
            return back()->with('error', 'Please Generate the Tech Pack for the Order');
        }
    }

    public function requestForAdvancePayment(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "REQUEST FOR ADVANCE PAYMENT";
        $order->save();

        $subjectLine = "Advance Payment Requested";
        $content = "Mr. " . \Auth::user()->name . " Has Raised a Request To The Customer For Making An Advance Payment Towards The Order.";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, null, "REQUEST FOR ADVANCE PAYMENT");

        $subjectLine = "Mr. " . \Auth::user()->name . " Requested for Advance Payment for the Order.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Order Status Updated Successfully');
    }

    public function confirmAdvancePayment(Request $request, $id) {

        $order = Order::find($id);
        if(count($order->customerPayments()->get()) > 0) {
          $order->orderStatus = "ADVANCE PAYMENT CONFIRMED";
          $order->save();

          $subjectLine = "Advance Payment Confirmed";
          $content = "Mr. " . \Auth::user()->name . " Has Confirmed That Advance Payment Has Been Received From the Customer.";
          $additionalInfo = "Advance Payment Has Been Received From The Customer. Payment Details Will be Added Shortly.";
          OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, $additionalInfo, "ADVANCE PAYMENT CONFIRMED");

          $subjectLine = "Mr. " . \Auth::user()->name . " confirmed the Advance Payment for the Order.";
          $link = "/order/displayOrder/" . $order->id;
          Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

          return back()->with('success', 'Advance Payment Confirmed Successfully');
        }
        return back()->with('error', 'Please Record The Customer Advance Payment Details.');
    }

    public function confirmPaymentReceipt(Request $request, $id) {

        $order = Order::find($id);
        if(count($order->customerPayments()->get()) > 0) {
          $order->orderStatus = "ADVANCE PAYMENT RECEIPT GENERATED";
          $order->save();

          $subjectLine = "Advance Payment Receipt Generated";
          $content = "Mr. " . \Auth::user()->name . " Has Generated The Advance Payment Receipt For The Order";
          $linkDescr = "View Advance Payment Receipt";
          $link = "/order/paymentReceipt/display/" . $id;
          OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, $linkDescr, $link, null, "ADVANCE PAYMENT RECEIPT GENERATED");

          $subjectLine = "Mr. " . \Auth::user()->name . " confirmed the Advance Payment Receipt for the Order.";
          $link = "/order/paymentReceipt/display/" . $id;
          Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

          return back()->with('success', 'Payment Receipt Confirmed Successfully');
        }
        return back()->with('error', 'Please Record The Customer Advance Payment Details.');
    }

    public function confirmPurchaseOrder(Request $request, $id) {

        $order = Order::find($id);
        if($order->purchaseOrderNumber != '///////////////') {
            $order->orderStatus = "PURCHASE ORDER CREATED";
            $order->save();

            $subjectLine = "Purchase Order Created";
            $content = "Mr. " . \Auth::user()->name . " Has Raised The Purchase Order With The Vendor";
            $linkDescr = "View Purchase Order";
            $link = "/order/admin/purchaseOrder/display/" . $id . "/" . $order->enquiry_id;
            OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, $linkDescr, $link, null, "PURCHASE ORDER CREATED");

            $subjectLine = "Mr. " . \Auth::user()->name . " confirmed the Purchase Order.";
            $link = "/order/admin/purchaseOrder/display/" . $id . "/" . $order->enquiry_id;
            Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

            return back()->with('success', 'Purchase Order Confirmed Successfully');
        }
        return back()->with('error', 'Please Create the Purchase Order Request for the Order');
    }

    public function confirmOrderToProduction(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "ORDER SENT TO PRODUCTION";
        $order->save();

        $subjectLine = "Order Sent To Production";
        $content = "Mr. " . \Auth::user()->name . " Has Confirmed The Order With The Production.";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, null, "ORDER SENT TO PRODUCTION");

        $subjectLine = "Mr. " . \Auth::user()->name . " confirmed the Order to Production.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Order Confirmed To Production Successfully');
    }

    public function requestForProductionSamples(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "PRODUCTION SAMPLES REQUESTED";
        $order->save();

        $subjectLine = "Production Samples Requested";
        $content = "Mr. " . \Auth::user()->name . " Has Raised a Request To The Production Team For Providing Samples Towards The Order.";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, null, "PRODUCTION SAMPLES REQUESTED");

        $subjectLine = "Mr. " . \Auth::user()->name . " Requested for Production Samples.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Order Status Updated Successfully');
    }

    public function requestForRevisedProductionSamples(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "REVISED PRODUCTION SAMPLES REQUESTED";
        $order->save();

        $subjectLine = "Revised Production Samples Requested";
        $content = "Mr. " . \Auth::user()->name . " Has Raised a Request To The Production Team For Providing The Revised Samples Towards The Order.";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, null, "REVISED PRODUCTION SAMPLES REQUESTED");

        $subjectLine = "Mr. " . \Auth::user()->name . " Requested for Revised Production Samples.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Order Status Updated Successfully');
    }

    public function confirmProductionSamples(Request $request, $id) {

      $order = Order::find($id);
      $order->orderStatus = "PRODUCTION SAMPLES CONFIRMED";
      $order->save();

      $subjectLine = "Production Samples Confirmed";
      $content = "Mr. " . \Auth::user()->name . " Has Confirmed the Samples Received To The Production Team Towards The Order.";
      OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, null, "PRODUCTION SAMPLES CONFIRMED");

      $subjectLine = "Mr. " . \Auth::user()->name . " Confirmed the Production Samples.";
      $link = "/order/displayOrder/" . $order->id;
      Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

      return back()->with('success', 'Order Status Updated Successfully');
    }


    public function proceedWithBulkPrintProduction(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "PRODUCTION BULK PRINTING CONFIRMED";
        $order->save();

        $subjectLine = "Production Bulk Printing Confirmed";
        $content = "Mr. " . \Auth::user()->name . " Has Confirmed To Proceed With Mass Production.";
        $additionalInfo = "Customer Agreed With The Samples Products Provided. Confirming The Production Team To Proceed With Bulk Printing And Informing About The Tentative Delivery Dates.";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, $additionalInfo, "PRODUCTION BULK PRINTING CONFIRMED");

        $subjectLine = "Mr. " . \Auth::user()->name . " Confirmed the Production Bulk Printing.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Bulk Order Print Confirmed To Production Successfully');
    }

    public function productionShipmentUnderProgress(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "ORDER SHIPPED";
        $order->save();

        $subjectLine = "Order Shipped";
        $content = "Mr. " . \Auth::user()->name . " Has Confirmed Shipment Of The Order";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, null, "ORDER SHIPPED");

        $subjectLine = "Mr. " . \Auth::user()->name . " Confirmed Regarding Order Shipment.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Order Shipped Successfully');
    }

    public function confirmDeliveryChallan(Request $request, $id) {

      $order = Order::find($id);
      if(count($order->deliveryChallans()->get()) > 0) {
        $order->orderStatus = "DELIVERY CHALLAN GENERATED";
        $order->save();

        $subjectLine = "Delivery Challan Generated";
        $content = "Mr. " . \Auth::user()->name . " Has Generated The Delivery Challan For The Order";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, null, "DELIVERY CHALLAN GENERATED");

        $subjectLine = "Mr. " . \Auth::user()->name . " Generated the Delivery Challan.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Delivery Challan Created Successfully');
      }

      return back()->with('error', 'Please Generate the Delivery Challan for the Order');

    }

    public function confirmOrderDelivery(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "ORDER DELIVERED";
        $order->save();

        $subjectLine = "Order Delivered";
        $content = "Mr. " . \Auth::user()->name . " Has Confirmed With The Customer and Order Has Been Delivered.";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, null, "ORDER DELIVERED");

        $subjectLine = "Mr. " . \Auth::user()->name . " confirmed the Order Delivery.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Order Delivered Successfully');
    }

    public function confirmTaxInvoice(Request $request, $id) {

      $order = Order::find($id);
      if($order->invoiceDate != null && $order->invoiceDueDate != null) {
          $order->orderStatus = "TAX INVOICE GENERATED";
          $order->save();

          $subjectLine = "Tax Invoice Generated";
          $content = "Mr. " . \Auth::user()->name . " Has Generated The Tax Invoice For The Order";
          $linkDescr = "View Tax Invoice";
          $link = "/order/invoice/display/" . $id . "/" . $order->enquiry_id;
          OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, $linkDescr, $link, null, "TAX INVOICE GENERATED");

          $subjectLine = "Mr. " . \Auth::user()->name . " confirmed the Tax Invoice for the Order.";
          $link = "/order/invoice/display/" . $id . "/" . $order->enquiry_id;;
          Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

          return back()->with('success', 'Tax Invoice Generated Successfully');
      }

      return back()->with('error', 'Please Generate the Tax Invoice for the Order');

    }

    public function requestOrderPendingPayment(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "REQUEST FOR PENDING PAYMENT";
        $order->save();

        $subjectLine = "Requested For Pending Payment";
        $content = "Mr. " . \Auth::user()->name . " Has Requested With The Customer To Clear The Pending Payment Due.";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, null, "REQUEST FOR PENDING PAYMENT");

        $subjectLine = "Mr. " . \Auth::user()->name . " Requested for Pending Payment for the Order.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Request Customer for Pending Payment');
    }

    public function confirmFullOrderPayment(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "FULL ORDER PAYMENT RECEIVED";
        $order->save();

        $subjectLine = "Full Payment Received";
        $content = "Mr. " . \Auth::user()->name . " Has Confirmed That Full Payment Has Been Received From the Customer.";
        $additionalInfo = "Full Payment Has Been Received From The Customer. Payment Receipt Details Will be Added Shortly.";
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, null, null, $additionalInfo, "FULL ORDER PAYMENT RECEIVED");

        $subjectLine = "Mr. " . \Auth::user()->name . " Confirmed the Full Payment for the Order.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Full Payment Received For The Order');
    }

    public function confirmFinalPaymentReceipt(Request $request, $id) {

        $order = Order::find($id);
        $order->orderStatus = "FINAL PAYMENT RECEIPT GENERATED";
        $order->save();

        $subjectLine = "Final Payment Receipt Generated";
        $content = "Mr. " . \Auth::user()->name . " Has Generated The Final Payment Receipt For The Order";
        $linkDescr = "View Final Payment Receipt";
        $link = "/order/paymentReceipt/display/" . $id;
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, $linkDescr, $link, null, "FINAL PAYMENT RECEIPT GENERATED");

        $subjectLine = "Mr. " . \Auth::user()->name . " Confirmed the Final Payment Receipt for the Order.";
        $link = "/order/paymentReceipt/display/" . $id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Final Payment Receipt Generated Successfully');
    }

    public function completeOrder(Request $request, $id) {

        $order = Order::find($id);
        $customerPaymentRecordedAmt = app('App\Http\Controllers\AdminOrdersController')->getPreviousCustomerPayments($id, $order->enquiry_id);
        $vendorPaymentRecordedAmt = app('App\Http\Controllers\AdminOrdersController')->getPreviousVendorPayments($id, $order->enquiry_id);

        // Check Customer Payments are Entered
        if($order->orderAmount - $customerPaymentRecordedAmt > 1) {

            return back()->with('error', 'Please Record The Customer Payment Details. Pending Due Amount Exists!');
        }

        // Check Vendor Payments are Entered
        if($order->vendorAmount - $vendorPaymentRecordedAmt > 1) {

            return back()->with('error', 'Please Record The Vendor Payment Details. Pending Due Amount Exists!');
        }

        $order->orderStatus = "ORDER COMPLETED";
        $order->save();

        $subjectLine = "Order Completed";
        $content = "Mr. " . \Auth::user()->name . " Has Completed The Order.";
        $linkDescr = "View Order Details";
        $link = "/order/displayOrder/" . $id;
        OrderCycle::addLogEntry($order->enquiry_id, $subjectLine, $content, $linkDescr, $link, null, "ORDER COMPLETED");

        $subjectLine = "Mr. " . \Auth::user()->name . " Completed the Order.";
        $link = "/order/displayOrder/" . $order->id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return back()->with('success', 'Order Completed Successfully');
    }
}
