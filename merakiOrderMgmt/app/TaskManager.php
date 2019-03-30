<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserTasks;
use App\Notifications\UserActions;
use App\User;

class TaskManager extends Model
{
  public function taskNotes() {

      return $this->hasMany('App\TaskNotes');
  }

  public static function addTaskEntry($id, $priority, $data, $link) {

      $user = User::find($id);
      $user->notify(new UserTasks($priority, $data, $link));
  }

  public static function addNotificationEntry($users, $data, $link) {

      Notification::send($users, new UserActions($data, $link));
  }
}
