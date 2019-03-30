<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCycle extends Model
{
    public static $statusFaIconsArr = array(

          "IN PROGRESS" => "fa fa-send-o bg-yellow",
          "REQUEST FOR QUOTATION" => "fa fa-clone bg-yellow",
          "QUOTATION GENERATED" => "fa fa-file-pdf-o bg-yellow",
          "REQUEST FOR REVISED QUOTATION" => "fa fa-clone bg-yellow",
          "REQUEST FOR ORDER CONFIRMATION" => "fa fa-reorder bg-yellow",
          "APPROVED" => "fa fa-check bg-yellow",
          "ORDER CONFIRMED" => "fa fa-bookmark-o bg-yellow",
          "PROFORMA INVOICE & TECH PACK GENERATED" => "fa fa-file-pdf-o bg-yellow",
          "REQUEST FOR ADVANCE PAYMENT" => "fa fa-cc-visa bg-yellow",
          "ADVANCE PAYMENT CONFIRMED" => "fa fa-cc-visa bg-yellow",
          "ADVANCE PAYMENT RECEIPT GENERATED" => "fa fa-file-pdf-o bg-yellow",
          "PURCHASE ORDER CREATED" => "fa fa-files-o bg-yellow",
          "ORDER SENT TO PRODUCTION" => "fa fa-send-o bg-yellow",
          "PRODUCTION SAMPLES REQUESTED" => "fa fa-send-o bg-yellow",
          "PRODUCTION BULK PRINTING CONFIRMED" => "fa fa-print bg-yellow",
          "ORDER SHIPPED" => "fa fa-shopping-cart bg-yellow",
          "DELIVERY CHALLAN GENERATED" => "fa fa-files-o bg-yellow",
          "ORDER DELIVERED" => "fa fa-send-o bg-yellow",
          "TAX INVOICE GENERATED" => "fa fa-files-o bg-yellow",
          "REQUEST FOR PENDING PAYMENT" => "fa fa-cc-visa bg-yellow",
          "FULL ORDER PAYMENT RECEIVED" => "fa fa-cc-visa bg-yellow",
          "FINAL PAYMENT RECEIPT GENERATED" => "fa fa-file-archive-o bg-yellow",
          "ORDER COMPLETED" => "fa fa-check bg-yellow"
    );

    public static function addLogEntry($enquiryId, $subject, $content, $linkDescr, $link, $additionalInfo, $status) {

        $orderCycle = new OrderCycle();
        $orderCycle->enquiry_id = $enquiryId;
        $orderCycle->concernedLeadPerson = \Auth::user()->name;
        $orderCycle->indicativeIcon = OrderCycle::$statusFaIconsArr[$status];
        $orderCycle->subject = $subject;
        $orderCycle->content = $content;
        $orderCycle->logDate = \Carbon\Carbon::now("Asia/Kolkata")->format("d-M-Y");
        $orderCycle->logTime = \Carbon\Carbon::now("Asia/Kolkata")->format("h:i A");
        $orderCycle->linkDescription = $linkDescr;
        $orderCycle->hyperLink = $link;
        $orderCycle->order_status = $status;
        if($additionalInfo != null) {
          $orderCycle->additionalInfo = "Mr. " . \Auth::user()->name . " added the comments: " . $additionalInfo;
        }
        $orderCycle->save();
    }
}
