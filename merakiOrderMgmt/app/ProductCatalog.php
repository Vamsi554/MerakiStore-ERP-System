<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\UserActions;


class ProductCatalog extends Model
{
  public static function addNotificationEntry($data, $link) {

      $users = User::where('email', '!=', \Auth::user()->email)->get();
      Notification::send($users, new UserActions($data, $link));
  }
}
