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
use App\VendorPayments;
use App\OrderDeliveryChallan;
use App\ProductCatalog;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\UserActions;
use App\Notifications\UserTasks;




class AdminOrdersController extends Controller
{
    // Manage Orders
    public function manageOrders() {

      $orders = Order::orderBy('created_at', 'DESC')->get();

      if(count($orders) > 0) {
          return view('adminOrders.manageAdminOrders', compact('orders'));
      }
      else {
          return view('orders.dummy');
      }
    }

    public function getNextSequence($count) {

        return sprintf("%'.04d", $count + 1);
    }

    public function getProductTaxDetails($prodCode) {

      $productFeatures = ProductCatalog::where('product_category',$prodCode)->select('hsn_code', 'gst_tax')->get();
      return $productFeatures[0];
    }

    public function createPO($orderId, $enquiryId) {

      $enquiry = Enquiry::find($enquiryId);
      $enquiryRequirements = $enquiry->enquiryRequirements()->where('status', 'Approved')->get();
      $vendorDtls = Vendor::select('vendor_code')->get();
      $hsnCodeArr = array();
      $gstTaxArr = array();

      for($i=0; $i<count($enquiryRequirements); $i++) {
          $prodDtls = $this->getProductTaxDetails($enquiryRequirements[$i]->product_category);
          $hsnCodeArr[$i] = $prodDtls->hsn_code;
          $gstTaxArr[$i] = $prodDtls->gst_tax;
      }
      return view('adminOrders.purchaseOrder', compact('enquiry', 'enquiryRequirements', 'orderId', 'vendorDtls', 'hsnCodeArr', 'gstTaxArr'));
    }

    public function savePO(Request $request, $id) {

      $order = Order::find($id);
      $vendorTotalAmount = 0;

      $vendorPoCount = count(VendorPurchaseOrdersLinkage::all());

      $poCodeGen = "MER_PO_";
      $poCodeGen .= $this->getNextSequence($vendorPoCount);

      $poTblCount = (int) $request->reqCount;
      $prodCatArr = $request->prodCat;
      $prodDescrArr = $request->prodDescr;
      $prodHsnArr = $request->hsnCode;
      $quantityArr = $request->quantity;
      $costPerUnitArr = $request->costPerUnit;
      $gstTaxArr = $request->gstTax;
      $x = 0;

      while($x < $poTblCount) {

          $vendorPurchaseOrder = new VendorPurchaseOrders();
          $vendorPurchaseOrder->order_id = $id;
          $vendorPurchaseOrder->poCreDttm = $request->poCreDttm;
          $vendorPurchaseOrder->validity_date = $request->poCreDttm;
          $vendorPurchaseOrder->purchase_order_code = $poCodeGen;
          $vendorPurchaseOrder->product_category = $prodCatArr[$x];
          $vendorPurchaseOrder->product_description = $prodDescrArr[$x];
          $vendorPurchaseOrder->hsn_code = $prodHsnArr[$x];
          $vendorPurchaseOrder->quantity = $quantityArr[$x];
          $vendorPurchaseOrder->cost_per_unit = $costPerUnitArr[$x];
          $vendorPurchaseOrder->gst_tax = $gstTaxArr[$x];
          $gstTaxAmount = ($costPerUnitArr[$x] * $gstTaxArr[$x])/100;
          $vendorTotalAmount += $quantityArr[$x] * ($costPerUnitArr[$x] + $gstTaxAmount);
          $order->purchaseOrders()->save($vendorPurchaseOrder);
          $x++;
      }

      // Terms & Conditions
      $poTermsConditions = "";
      $poTcTblCount = (int) $request->reqCountTc;
      $statusArr = $request->status;
      $termsConditionsTextArr = $request->termsConditionsText;
      $v = 0;

      while($v < $poTcTblCount) {

          $poTermsConditions .= $statusArr[$v] . "@" . $termsConditionsTextArr[$v] . "#";
          $v++;
      }

      $vendorPurchaseOrderLink = new VendorPurchaseOrdersLinkage();
      $vendorPurchaseOrderLink->order_id = $id;
      $vendorPurchaseOrderLink->purchase_order_code = $poCodeGen;
      $vendorPurchaseOrderLink->vendor_code = $request->vendorCd;
      $vendorPurchaseOrderLink->vendor_terms_conditions = substr($poTermsConditions, 0,-1);
      $vendorPurchaseOrderLink->vendor_notes = $request->notes;
      $vendorPurchaseOrderLink->vendor_payment_amount = $vendorTotalAmount;
      $vendorPurchaseOrderLink->save();

      $order->purchaseOrderNumber = $poCodeGen;
      $order->vendorAmount = $vendorTotalAmount;
      $order->save();

      $subjectLine = "Mr. " . \Auth::user()->name . " Created the Purchase Order Successfully";
      $link = "/order/admin/purchaseOrder/display/" . $order->id . "/" . $order->enquiry_id;
      Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

      return redirect('/order/admin/display/' . $id . '/' . $order->enquiry_id)->with('success', 'Purchase Order Created Successfully.');
    }

    public function displayPO($orderId, $enquiryId) {

      $enquiry = Enquiry::find($enquiryId);
      $order = Order::find($orderId);
      $enquiryRequirements = $enquiry->enquiryRequirements()->where('status', 'Approved')->get();
      $vendorPurchaseOrderDtls = $order->purchaseOrders()->get();
      $vendorPOLinkDtls = VendorPurchaseOrdersLinkage::where('purchase_order_code', $vendorPurchaseOrderDtls[0]->purchase_order_code)->get();
      $vendorDtls = Vendor::where('vendor_code',$vendorPOLinkDtls[0]->vendor_code)->get();
      $vendorNotes = $vendorPOLinkDtls[0]->vendor_notes;
      $vendorAmount = $vendorPOLinkDtls[0]->vendor_payment_amount;

      $vendorTermsConditions = array();
      $vendorTerms = $vendorPOLinkDtls[0]->vendor_terms_conditions;
      $vendorTermsSplit = explode("#", $vendorTerms);
      for($i=0; $i<count($vendorTermsSplit); $i++) {

            $indvVendorTerm = explode("@", $vendorTermsSplit[$i]);
            if($indvVendorTerm[0] == 'Enable') {
                array_push($vendorTermsConditions, $indvVendorTerm[1]);
            }
      }

      return view('documents.generatePurchaseOrder', compact('enquiry', 'enquiryRequirements', 'vendorPurchaseOrderDtls', 'vendorDtls', 'vendorNotes', 'vendorTermsConditions', 'vendorAmount'));
    }

    public function editPO($orderId, $enquiryId, $poCd) {

        $order = Order::find($orderId);
        $enquiry = Enquiry::find($enquiryId);
        $enquiryRequirements = $enquiry->enquiryRequirements()->where('status', 'Approved')->get();
        $vendorPurchaseOrder = $order->purchaseOrders()->where('purchase_order_code', $poCd)->get();
        $vendorPOLinkage = VendorPurchaseOrdersLinkage::where('purchase_order_code', $poCd)->get();
        $vendorDtls = Vendor::select('vendor_code')->get();
        $termsConditionsTextArr = explode("#", $vendorPOLinkage[0]->vendor_terms_conditions);
        $statusArr = array();
        $termsArr = array();
        for($i=0; $i<count($termsConditionsTextArr); $i++) {

            $terms = explode("@", $termsConditionsTextArr[$i]);
            $statusArr[$i] = $terms[0];
            $termsTextArr[$i] = $terms[1];
        }
        return view('adminOrders.editPurchaseOrder', compact('enquiry', 'order', 'vendorPurchaseOrder', 'statusArr', 'termsTextArr', 'vendorPOLinkage', 'vendorDtls', 'enquiryRequirements'));
    }

    public function updatePO(Request $request, $orderId, $enquiryId, $poCd) {

        $order = Order::find($orderId);
        $poTblCount = (int) $request->reqCount;
        $prodCatArr = $request->prodCat;
        $prodDescrArr = $request->prodDescr;
        $prodHsnArr = $request->hsnCode;
        $quantityArr = $request->quantity;
        $costPerUnitArr = $request->costPerUnit;
        $gstTaxArr = $request->gstTax;
        $x = 0;
        $vendorTotalAmount = 0;

        $order->purchaseOrders()->delete();

        while($x < $poTblCount) {

            $vendorPurchaseOrder = new VendorPurchaseOrders();
            $vendorPurchaseOrder->order_id = $orderId;
            $vendorPurchaseOrder->poCreDttm = $request->poCreDttm;
            $vendorPurchaseOrder->validity_date = $request->poCreDttm;
            $vendorPurchaseOrder->purchase_order_code = $poCd;
            $vendorPurchaseOrder->product_category = $prodCatArr[$x];
            $vendorPurchaseOrder->product_description = $prodDescrArr[$x];
            $vendorPurchaseOrder->hsn_code = $prodHsnArr[$x];
            $vendorPurchaseOrder->quantity = $quantityArr[$x];
            $vendorPurchaseOrder->cost_per_unit = $costPerUnitArr[$x];
            $vendorPurchaseOrder->gst_tax = $gstTaxArr[$x];
            $gstTaxAmount = ($costPerUnitArr[$x] * $gstTaxArr[$x])/100;
            $vendorTotalAmount += $quantityArr[$x] * ($costPerUnitArr[$x] + $gstTaxAmount);
            $order->purchaseOrders()->save($vendorPurchaseOrder);
            $x++;
        }

        // Terms & Conditions
        $poTermsConditions = "";
        $poTcTblCount = (int) $request->reqCountTc;
        $statusArr = $request->status;
        $termsConditionsTextArr = $request->termsConditionsText;
        $v = 0;

        while($v < $poTcTblCount) {

            $poTermsConditions .= $statusArr[$v] . "@" . $termsConditionsTextArr[$v] . "#";
            $v++;
        }

        $vendorPurchaseOrderLink = VendorPurchaseOrdersLinkage::where('purchase_order_code', $poCd)->get();
        $vendorPurchaseOrderLink[0]->vendor_code = $request->vendorCd;
        $vendorPurchaseOrderLink[0]->vendor_terms_conditions = substr($poTermsConditions, 0,-1);
        $vendorPurchaseOrderLink[0]->vendor_notes = $request->notes;
        $vendorPurchaseOrderLink[0]->vendor_payment_amount = $vendorTotalAmount;
        $vendorPurchaseOrderLink[0]->save();

        $order->vendorAmount = $vendorTotalAmount;
        $order->save();

        $subjectLine = "Mr. " . \Auth::user()->name . " Updated the Purchase Order Successfully";
        $link = "/order/admin/purchaseOrder/display/" . $order->id . "/" . $order->enquiry_id;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return redirect('/order/admin/display/' . $orderId . '/' . $enquiryId)->with('success', 'Purchase Order Updated Successfully.');
    }

    public function displayAdminOrder($orderId, $enquiryId) {

      $order = Order::find($orderId);
      $enquiry = Enquiry::find($enquiryId);
      $quotationCd = $order->quotationNumber;
      $enquiryRequirements = $enquiry->enquiryRequirements()->where('status', 'Approved')->get();
      $enquiryQuote = $enquiry->enquiryQuotations()->where('quotation_code', $quotationCd)->get();
      $orderStatusUpdates = $order->statusUpdates()->where('order_status', $order->orderStatus)->get();
      return view('adminOrders.displayAdminOrder', compact('order', 'enquiry', 'enquiryRequirements', 'enquiryQuote', 'orderStatusUpdates'));
    }

    public function getPreviousCustomerPayments($orderId, $enquiryId) {

        $prevCustomerPayAmt = CustomerPayments::where(['order_id' => $orderId, 'enquiry_id' => $enquiryId])->sum('total_payment_amount');
        return $prevCustomerPayAmt;
    }

    public function createCustomerPaymentRecord($orderId) {

        $order = Order::find($orderId);
        $customerPendingDueAmt = $order->orderAmount - $this->getPreviousCustomerPayments($orderId, $order->enquiry_id);
        return view('adminOrders.customerPayments', compact('order', 'customerPendingDueAmt'));
    }

    public function createVendorPaymentRecord($orderId) {

        $order = Order::find($orderId);
        $vendorPoLink = VendorPurchaseOrdersLinkage::where('order_id', $orderId)->get();
        $vendorPendingDueAmt = $order->vendorAmount - $this->getPreviousVendorPayments($orderId, $order->enquiry_id);
        return view('adminOrders.vendorPayments', compact('order', 'vendorPoLink', 'vendorPendingDueAmt'));
    }

    public function saveCustomerPaymentRecord(Request $request, $orderId) {

        $order = Order::find($orderId);
        $customerPaymentsCount = count($order->customerPayments()->get());

        if(($request->cashAmount + $request->chequeAmount + $request->transactionAmount + $this->getPreviousCustomerPayments($orderId, $order->enquiry_id)) > $order->orderAmount) {

            return back()->with('error', 'Oops! Payment Details Exceeds Order Amount. Please Verify the Amounts Entered!');
        }

        $customerPayment = new CustomerPayments();
        $customerPayment->cust_pay_code = "MER_PAY_" . $this->getNextSequence($customerPaymentsCount);
        $customerPayment->order_id = $orderId;
        $customerPayment->enquiry_id = $order->enquiry_id;

        $customerPayment->cash_amount = $request->cashAmount;
        $customerPayment->payment_date = $request->paymentDate;
        $customerPayment->received_from_person = $request->rcvdFromPer;

        $customerPayment->bank_cheque = $request->bankName;
        $customerPayment->cheque_number = Crypt::encryptString($request->chequeNumber);
        $customerPayment->cheque_amount = $request->chequeAmount;
        $customerPayment->cheque_date = $request->chequeDate;

        $customerPayment->transaction_id = Crypt::encryptString($request->transactionId);
        $customerPayment->bank_name = $request->transactionBankName;
        $customerPayment->customer_from_account_number = Crypt::encryptString($request->customerAccountNumber);
        $customerPayment->meraki_to_account_number = Crypt::encryptString($request->merakiAccountNumber);
        $customerPayment->transaction_amount = $request->transactionAmount;
        $customerPayment->transaction_date = $request->transactionDate;

        $customerPayment->total_payment_amount = $request->cashAmount + $request->chequeAmount + $request->transactionAmount;

        $order->customerPayments()->save($customerPayment);

        $subjectLine = "Mr. " . \Auth::user()->name . " Added the Customer Payments Information";
        $link = "/order/paymentReceipt/display/" . $order->id ;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return redirect('/order/admin/display/' . $orderId . '/' . $order->enquiry_id)->with('success', 'Customer Payment Recorded Successfully');
    }

    public function getCustomerPaymentReceipt($orderId, $custPayCode) {

        $order = Order::find($orderId);
        $enquiry = Enquiry::find($order->enquiry_id);
        $enquiryQuote = $enquiry->enquiryQuotations()->where('quotation_code', $order->quotationNumber)->get();
        $customerPayments = $order->customerPayments()->where('cust_pay_code', $custPayCode)->get();
        $customerName = $enquiry->name;
        $enquiryQuoteLinkage = EnquiryQuotationLinkage::where('quotation_code', $order->quotationNumber)->get();
        return view('documents.paymentReceipt', compact('customerName', 'order', 'enquiryQuote', 'customerPayments', 'enquiryQuoteLinkage'));
    }

    public function getVendorPaymentDetails($orderId) {

        $order = Order::find($orderId);
        $vendorPayments = $order->vendorPayments()->get();
        $vendorPoLink = VendorPurchaseOrdersLinkage::where('order_id', $orderId)->get();
        return view('documents.vendorPaymentDetails', compact('order', 'vendorPayments', 'vendorPoLink'));
    }

    public function saveVendorPaymentRecord(Request $request, $orderId) {

        $order = Order::find($orderId);
        $vendorPaymentsCount = count($order->vendorPayments()->get());

        if(($request->cashAmount + $request->chequeAmount + $request->transactionAmount + $this->getPreviousVendorPayments($orderId, $order->enquiry_id)) > $order->vendorAmount) {

            return back()->with('error', 'Oops! Payment Details Exceeds Vendor Payment Amount. Please Verify the Amounts Entered!');
        }

        $vendorPayment = new VendorPayments();
        $vendorPayment->vendor_pay_code = "MER_VEN_PAY_" . $this->getNextSequence($vendorPaymentsCount);
        $vendorPayment->order_id = $orderId;
        $vendorPayment->enquiry_id = $order->enquiry_id;

        $vendorPayment->cash_amount = $request->cashAmount;
        $vendorPayment->payment_date = $request->paymentDate;
        $vendorPayment->paid_to_person = $request->paidToPer;

        $vendorPayment->bank_cheque = $request->bankName;
        $vendorPayment->cheque_number = Crypt::encryptString($request->chequeNumber);
        $vendorPayment->cheque_amount = $request->chequeAmount;
        $vendorPayment->cheque_date = $request->chequeDate;

        $vendorPayment->transaction_id = Crypt::encryptString($request->transactionId);
        $vendorPayment->bank_name = $request->transactionBankName;
        $vendorPayment->meraki_from_account_number = Crypt::encryptString($request->merakiAccountNumber);
        $vendorPayment->vendor_to_account_number = Crypt::encryptString($request->vendorAccountNumber);
        $vendorPayment->transaction_amount = $request->transactionAmount;
        $vendorPayment->transaction_date = $request->transactionDate;

        $vendorPayment->total_payment_amount = $request->cashAmount + $request->chequeAmount + $request->transactionAmount;

        $order->vendorPayments()->save($vendorPayment);

        $subjectLine = "Mr. " . \Auth::user()->name . " Added the Vendor Payments Details";
        $link = "/order/admin/vendor/paymentReceipt/display/" . $order->id ;
        Order::addNotificationEntry($order->orderDetails . " - " . $subjectLine, $link);

        return redirect('/order/admin/display/' . $orderId . '/' . $order->enquiry_id)->with('success', 'Vendor Payment Recorded Successfully');
    }

    public function getPreviousVendorPayments($orderId, $enquiryId) {

        $prevVendorPayAmt = VendorPayments::where(['order_id' => $orderId, 'enquiry_id' => $enquiryId])->sum('total_payment_amount');
        return $prevVendorPayAmt;
    }

    public function saveProforma(Request $request, $orderId, $enquiryId) {

        $orderCount = count(Order::all()) - 1;
        $proformaGen = "MER_PF_";
        $proformaGen .= $this->getNextSequence($orderCount);
        $order = Order::find($orderId);
        $order->client_gst_number = $request->clientGstNum;
        $order->advancePaymentPercentage = $request->advPayPer;
        $order->proformaInvoiceNumber = $proformaGen;
        $order->save();
        return back()->with('success', 'Proforma Invoice Generated Successfully');
    }

    public function viewProforma($orderId, $enquiryId) {

        $order = Order::find($orderId);
        $enquiry = Enquiry::find($enquiryId);
        $enquiryQuote = $enquiry->enquiryQuotations()->where('quotation_code', $order->quotationNumber)->get();
        $enquiryQuoteLinkage = EnquiryQuotationLinkage::where('quotation_code', $order->quotationNumber)->get();
        return view('documents.proformaInvoice', compact('order', 'enquiryQuote', 'enquiryQuoteLinkage'));
    }

    public function saveDeliveryChallan(Request $request, $orderId, $enquiryId) {

        $orderDCCount = OrderDeliveryChallan::select('delivery_challan_code')->distinct('delivery_challan_code')->count('delivery_challan_code');

        $deliveryChallanGen = "MER_DC_";
        $deliveryChallanGen .= $this->getNextSequence($orderDCCount);

        $order = Order::find($orderId);
        $enquiry = Enquiry::find($enquiryId);
        $enquiryQuote = $enquiry->enquiryQuotations()->where('quotation_code', $order->quotationNumber)->get();
        $prodDescrArr = $request->prodDescrDC;
        $orderedQtyArr = $request->orderedQtyDC;
        $deliveredQtyArr = $request->deliveredQtyDC;

        for($i=0; $i<count($enquiryQuote); $i++) {

            $orderDeliveryChallan = new OrderDeliveryChallan();
            $orderDeliveryChallan->order_id = $orderId;
            $orderDeliveryChallan->delivery_challan_code = $deliveryChallanGen;
            $orderDeliveryChallan->way_bill_number = $request->wayBillNum;
            $orderDeliveryChallan->product_description = $prodDescrArr[$i];
            $orderDeliveryChallan->hsn_code = $enquiryQuote[$i]->hsn;
            $orderDeliveryChallan->total_quantity = $orderedQtyArr[$i];
            $orderDeliveryChallan->delivered_quantity = $deliveredQtyArr[$i];
            $orderDeliveryChallan->balance_quantity = $orderedQtyArr[$i] - $deliveredQtyArr[$i] - $this->getPreviousDeliveryQty($orderId, $prodDescrArr[$i], $enquiryQuote[$i]->hsn);
            $orderDeliveryChallan->transport_mode = $request->modeOfTransport;
            $orderDeliveryChallan->vehicle_number = $request->vehicleNum;
            $orderDeliveryChallan->place_of_supply = $request->placeOfSupply;
            $order->deliveryChallans()->save($orderDeliveryChallan);
        }

        return back()->with('success', 'Delivery Challan Generated Successfully');
    }

    public function getPreviousDeliveryQty($orderId, $prodDescr, $hsn) {

          $whereMatchCriteria = ['order_id' => $orderId, 'product_description' => $prodDescr, 'hsn_code' => $hsn];
          $prevDlvrdQty = OrderDeliveryChallan::where($whereMatchCriteria)->sum('delivered_quantity');
          return $prevDlvrdQty;
    }

    public function viewDeliveryChallan($orderId, $dcCode) {

        $order = Order::find($orderId);
        $orderDeliveryChallan = $order->deliveryChallans()->where('delivery_challan_code', $dcCode)->get();
        return view('documents.deliveryChallan', compact('dcCode', 'order', 'orderDeliveryChallan'));
    }

    public function saveInvoice(Request $request, $orderId) {

        $order = Order::find($orderId);
        $order->client_gst_number = $request->clientGstNum;
        $order->invoiceDate = $request->invoiceGenDate;
        $order->invoiceDueDate = $request->invoiceDueDate;
        $order->save();
        return back()->with('success', 'Tax Invoice Generated Successfully');
    }

    public function viewInvoice($orderId, $enquiryId) {

        $order = Order::find($orderId);
        $enquiry = Enquiry::find($enquiryId);
        $enquiryQuote = $enquiry->enquiryQuotations()->where('quotation_code', $order->quotationNumber)->get();
        $enquiryQuoteLinkage = EnquiryQuotationLinkage::where('quotation_code', $order->quotationNumber)->get();
        return view('documents.invoice', compact('order', 'enquiry', 'enquiryQuote', 'enquiryQuoteLinkage'));
    }

    public function createTechPack($orderId, $enquiryId) {

        $order = Order::find($orderId);
        $enquiry = Enquiry::find($enquiryId);
        $enquiryQuote = $enquiry->enquiryQuotations()->where('quotation_code', $order->quotationNumber)->select('product_description', 'quantity')->get();
        $prodCatArr = array();
        $prodQtyArr = array();
        for($i=0; $i<count($enquiryQuote); $i++) {
            $prodCatArr[$i] = $enquiryQuote[$i]->product_description;
            $prodQtyArr[$i] = $enquiryQuote[$i]->quantity;
        }
        return view('adminOrders.techPackOrder', compact('order', 'enquiry', 'prodCatArr', 'prodQtyArr'));
    }

    public function saveTechPack(Request $request, $orderId, $enquiryId) {

        $order = Order::find($orderId);
        $enquiry = Enquiry::find($enquiryId);
        $orderCount = count(Order::all()) - 1;

        $techPackGen = "MER_TECH_";
        $techPackGen .= $this->getNextSequence($orderCount);

        $techPackDt = $request->techPackCreDttm;
        $prodDescrArr = $request->prodDescr;
        $estDeliveryArr = $request->estDelivery;
        $breakUpArr = $request->breakUp;

        $order->techPackNumber = $techPackGen;
        $order->save();

        for($i=0; $i<count($prodDescrArr); $i++) {
            $enquiry->enquiryRequirements()->where(['product_description' => $prodDescrArr[$i], 'status' => 'Approved'])->update(['est_delivery' => $estDeliveryArr[$i], 'breakup_details' => $breakUpArr[$i], 'tech_pack_date' => $techPackDt]);
        }
        return redirect('/order/admin/display/' . $orderId . '/' . $enquiryId)->with('success', 'Tech Pack Generated Successfully');
    }

    public function viewTechPack($orderId, $enquiryId) {

        $order = Order::find($orderId);
        $enquiry = Enquiry::find($enquiryId);
        $enquiryRequirements = $enquiry->enquiryRequirements()->where('status', 'Approved')->get();
        return view('documents.techPack', compact('order', 'enquiry', 'enquiryRequirements'));
    }
}
