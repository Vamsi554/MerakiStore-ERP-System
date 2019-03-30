<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\UserActions;


class Order extends Model
{

  public function customerPayments() {

      return $this->hasMany('App\CustomerPayments');
  }

  public function vendorPayments() {

      return $this->hasMany('App\VendorPayments');
  }

  public function purchaseOrders() {

      return $this->hasMany('App\VendorPurchaseOrders');
  }

  public function deliveryChallans() {

      return $this->hasMany('App\OrderDeliveryChallan');
  }

  public function statusUpdates() {

      return $this->hasMany('App\OrderStatusUpdates');
  }

  public static function addNotificationEntry($data, $link) {

      $users = User::where('email', '!=', \Auth::user()->email)->get();
      Notification::send($users, new UserActions($data, $link));
  }
}
