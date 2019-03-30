<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Enquiry;
use App\EnquiryQuotations;
use App\EnquiryQuotationLinkage;
use App\Vendor;
use App\VendorPurchaseOrders;
use App\VendorPurchaseOrdersLinkage;
use App\CustomerPayments;
use App\OrderCycle;

use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\UserActions;
use App\Notifications\UserTasks;


class OrderController extends Controller
{
    public function index() {

      $orders = Order::orderBy('created_at', 'DESC')->get();
      $title = "All Orders";
      if(count($orders) > 0) {
          return view('orders.index', compact('orders', 'title'));
      }
      else {
          return view('orders.dummy', compact('title'));
      }
    }

    public function userLoginOrder()
    {
        $orders = Order::orderBy('created_at', 'DESC')->where('concernedLead', \Auth::user()->name)->get();
        $title = "My Orders";
        if(count($orders) > 0) {
            return view('orders.index', compact('orders', 'title'));
        }
        else {
            return view('orders.dummy', compact('title'));
        }
    }

    public function holdOrder()
    {
        $orders = Order::orderBy('created_at', 'DESC')->where('orderStatus', 'ORDER ON HOLD')->get();
        $title = "Hold Orders";
        if(count($orders) > 0) {
            return view('orders.index', compact('orders', 'title'));
        }
        else {
            return view('orders.dummy', compact('title'));
        }
    }

    public function cancelOrder()
    {
        $orders = Order::orderBy('created_at', 'DESC')->where('orderStatus', 'ORDER CANCELLED')->get();
        $title = "Cancelled Orders";
        if(count($orders) > 0) {
            return view('orders.index', compact('orders', 'title'));
        }
        else {
            return view('orders.dummy', compact('title'));
        }
    }

    public function create($enquiryId, $quotationId) {

        $enquiry = Enquiry::find($enquiryId);
        $enquiryQuote = $enquiry->enquiryQuotations()->where('quotation_code', $quotationId)->get();
        $orderAmount = 0;
        $orderSummary = "";
        $noOfProdCount = count($enquiryQuote);
        for($i=0; $i<$noOfProdCount; $i++) {

              $qty = $enquiryQuote[$i]->quantity;
              $cpu = $enquiryQuote[$i]->cost_per_unit;
              $taxAmt = $qty * $cpu;
              $totTax = ($taxAmt * $enquiryQuote[$i]->gst_tax) / 100.0;
              $orderAmount += $taxAmt + $totTax;
              $orderSummary .= $qty . " Units Of " . $enquiryQuote[$i]->product_description;

              if($i != $noOfProdCount-1) {
                  $orderSummary .= " / ";
              }
        }

        $orderDetails = "Event Details : " . $enquiry->eventName . ", " . $enquiry->eventPlace;
        $orderDetails .= " / Organization : " . $enquiry->organizationName;
        return view('orders.create', compact('quotationId', 'enquiry', 'enquiryQuote', 'orderAmount', 'orderSummary', 'orderDetails'));
    }

    public function store(Request $request, $enquiryId, $quotationId)
    {

      //validate post data
      $this->validate($request, [
          'orderStatus' => 'required',
          'expectedDelivery' => 'required',
          'billingAddress' => 'required',
          'shipmentAddress' => 'required',
          'shipmentContactPerson' => 'required',
          'shipmentContactNumber' => 'required'
      ]);

      $order = new Order();
      $order->enquiry_id = $request->enquiryId;
      $order->concernedLead = $request->concernedLead;
      $order->email = $request->email;
      $order->documentNumber = $request->documentNumber;
      $order->orderCreDttm = $request->orderCreDttm;
      $order->expectedDelivery = $request->expectedDelivery;
      $order->orderStatus = $request->orderStatus;
      $order->orderAmount = $request->orderAmount;
      $order->orderDetails = $request->orderDetails;
      $order->orderSummary = $request->orderSummary;
      $order->shipmentAddress = $request->shipmentAddress;
      $order->billingAddress = $request->billingAddress;
      $order->contactPersonAtShipment = $request->shipmentContactPerson;
      $order->contactNumberAtShipment = $request->shipmentContactNumber;
      $order->postOrderDeliveryComments = $request->commentsPostDelivery;
      $order->clientFeedback = $request->clientFeedback;
      $order->quotationNumber = $quotationId;
      $order->save();

      // Order Approval
      $subjectLine = "Order Created. Mr. " . $request->concernedLead . " Requested Admin For Order Confirmation.";
      $content = "Customer has agreed upon the quotation details. Mr. " . $request->concernedLead . " has created the order and requested Admin for reviewing the order details and confirmation.";
      $additionalInfo = "Approving the Enquiry. Order Has Been Created In The System. Awaiting Admin Confirmation.";
      $linkDescr = "View Order";
      $link = "/order/displayOrder/" . $order->id;
      OrderCycle::addLogEntry($enquiryId, $subjectLine, $content, $linkDescr, $link, $additionalInfo, "REQUEST FOR ORDER CONFIRMATION");

      Order::addNotificationEntry($request->orderDetails . " - " . $subjectLine, $link);

      // Enquiry Approval
      $enquiry = Enquiry::find($enquiryId);
      $enquiry->enquiryStatus = "APPROVED";
      $enquiry->enquiryComments = "Enquiry has been Confirmed and Order has been created in the system.";
      $enquiry->save();

      $enquiryQuoteLink = EnquiryQuotationLinkage::where('quotation_code', $quotationId)->get();
      $enquiryQuoteLink[0]->quotation_status = 'APPROVED';
      $enquiryQuoteLink[0]->save();

      $subjectLine = "Enquiry Approved";
      $content = "Mr. " . $request->concernedLead . " Approved the Enquiry. Proceeding with Creation of Order.";
      $linkDescr = "View Final Quotation";
      $link = "/enquiry/quotation/" . $enquiryId . "/" . $quotationId;
      $additionalInfo = "Proceeding with the Order on the Final Quotation Below.";
      OrderCycle::addLogEntry($enquiryId, $subjectLine, $content, $linkDescr, $link, $additionalInfo, "APPROVED");

      return redirect('/order')->with('success', 'Order Created Successfully');
    }

    public function show($id)
    {

        $order = Order::find($id);
        $enquiry = Enquiry::find($order->enquiry_id);
        $enquiryRequirements = $enquiry->enquiryRequirements()->where('status', 'Approved')->get();
        $orderStatusUpdates = $order->statusUpdates()->where('order_status', $order->orderStatus)->get();
        return view('orders.display', compact('order','enquiry', 'enquiryRequirements', 'orderStatusUpdates'));
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $enquiry = Enquiry::find($order->enquiry_id);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
      //validate post data
      $this->validate($request, [
          'orderStatus' => 'required',
          'expectedDelivery' => 'required',
          'billingAddress' => 'required',
          'shipmentAddress' => 'required',
          'shipmentContactPerson' => 'required',
          'shipmentContactNumber' => 'required'
      ]);

      $order = Order::find($id);
      $order->expectedDelivery = $request->expectedDelivery;
      $order->orderStatus = $request->orderStatus;
      $order->shipmentAddress = $request->shipmentAddress;
      $order->billingAddress = $request->billingAddress;
      $order->contactPersonAtShipment = $request->shipmentContactPerson;
      $order->contactNumberAtShipment = $request->shipmentContactNumber;
      $order->postOrderDeliveryComments = $request->commentsPostDelivery;
      $order->clientFeedback = $request->clientFeedback;

      $order->save();

      $link = "/order/displayOrder/" . $order->id;
      Order::addNotificationEntry("Mr. " . \Auth::user()->name . " has updated the order for " . $request->orderDetails . "", $link);
      return redirect('/order')->with('success', 'Order Updated Successfully');
    }

    public function generateInvoice($id) {

        $order = Order::find($id);
        $enquiry = Enquiry::find($order->enquiry_id);
        $enquiryReq = $enquiry->enquiryRequirements()->get();
        return view('documents.invoice', compact('id', 'order', 'enquiry', 'enquiryReq'));
    }

    public function generatePaymentReceipt($id) {

        return view('documents.paymentReceipt', compact('id'));
    }

    public function generateProformaInvoice($id) {
        return view('documents.proformaInvoice', compact('id'));
    }

    public function generateDeliveryChallan($id) {
        return view('documents.deliveryChallan', compact('id'));
    }

}
