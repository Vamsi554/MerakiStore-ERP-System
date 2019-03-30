<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class OrderStatusUpdates extends Model
{

  public static function addStatusUpdate($orderId, $enquiryId, $documentNumber, $orderStatus, $statusDescr) {

      $order = Order::find($orderId);
      $orderStatusUpdate = new OrderStatusUpdates();
      $orderStatusUpdate->order_id = $orderId;
      $orderStatusUpdate->enquiry_id = $enquiryId;
      $orderStatusUpdate->document_number = $documentNumber;
      $orderStatusUpdate->order_status = $orderStatus;
      $orderStatusUpdate->comments = $statusDescr;
      $orderStatusUpdate->user = \Auth::user()->name;
      $orderStatusUpdate->creation_dttm = \Carbon\Carbon::now("Asia/Kolkata")->format("d-M-Y h:i A");
      $order->statusUpdates()->save($orderStatusUpdate);
  }
}
