<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskNotes extends Model
{
  public function taskManager() {

      return $this->belongsTo('App\TaskManager');
  }
}
