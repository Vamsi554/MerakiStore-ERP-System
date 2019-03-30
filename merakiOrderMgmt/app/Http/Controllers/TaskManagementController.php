<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskManager;
use App\TaskNotes;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserActions;
use App\Notifications\UserTasks;


class TaskManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = TaskManager::where(function($query) {
                  $query->where('issuer', '=', \Auth::user()->email)
                        ->orWhere('issued_to', '=', \Auth::user()->email);
                 })->get();

        if(count($tasks) > 0) {
            return view('merakiTasks.index', compact('tasks'));
        }
        else {
            return view('merakiTasks.dummy');
        }
    }

    public function openTasks()
    {

        $tasks = TaskManager::where(function($query) {
                  $query->where('issuer', '=', \Auth::user()->email)
                        ->orWhere('issued_to', '=', \Auth::user()->email);
                 })->where('status', '=', 'Open')->get();

        if(count($tasks) > 0) {
            return view('merakiTasks.index', compact('tasks'));
        }
        else {
            return view('merakiTasks.dummy');
        }
    }

    public function closedTasks()
    {

        $tasks = TaskManager::where(function($query) {
                $query->where('issuer', '=', \Auth::user()->email)
                      ->orWhere('issued_to', '=', \Auth::user()->email);
               })->where('status', '=', 'Completed')->get();


        if(count($tasks) > 0) {
            return view('merakiTasks.index', compact('tasks'));
        }
        else {
            return view('merakiTasks.dummy');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('merakiTasks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //validate post data
      $this->validate($request, [
          'issuedTo' => 'required',
          'subject' => 'required',
          'description' => 'required',
          'startDate' => 'required',
          'endDate' => 'required'
      ]);

      $taskManager = new TaskManager();
      $taskId = "TASK_";
      $taskId .= date("mdyGis", time());
      $taskManager->task_id = $taskId;
      $taskManager->issuer = \Auth::user()->email;
      $taskManager->issued_to = $request->issuedTo;
      $taskManager->subject = $request->subject;
      $taskManager->description = $request->description;
      $taskManager->category = $request->category;
      $taskManager->start_dttm = $request->startDate;
      $taskManager->end_dttm = $request->endDate;
      $taskManager->client = $request->client;
      $taskManager->priority = $request->priority;
      $taskManager->save();

      $link = "/meraki/tasks/displayTask/" . $taskManager->id;
      $user = User::where(DB::raw("TRIM(email)"), $request->issuedTo)->get();
      TaskManager::addTaskEntry($user[0]->id, $request->priority, $request->subject, $link);

      return redirect('/meraki/tasks')->with('success', 'Task Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = TaskManager::find($id);
        $taskNotes = $task->taskNotes()->where('task_id', $task->task_id)->get();
        return view('merakiTasks.display', compact('task', 'taskNotes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = TaskManager::find($id);
        $users = User::all();
        return view('merakiTasks.edit', compact('task', 'users'));
    }

    public function addNoteOnTask(Request $request, $id)
    {
        //validate post data
        $this->validate($request, [
            'taskNote' => 'required'
        ]);
        $task = TaskManager::find($id);
        $taskNote = new TaskNotes();
        $taskNote->task_manager_id = $id;
        $taskNote->task_id = $task->task_id;
        $taskNote->user_email = \Auth::user()->email;
        $taskNote->user_name = \Auth::user()->name;
        $taskNote->notes = $request->taskNote;
        $task->taskNotes()->save($taskNote);

        $userEmail = "";
        if(\Auth::user()->email == $task->issuer) {
          $userEmail = $task->issued_to;
        }
        else {
          $userEmail = $task->issuer;
        }
        $user = User::where(DB::raw("TRIM(email)"), $userEmail)->get();
        $subjectLine = "Mr. " . \Auth::user()->name . " added a Status Update on the Task - " . $task->subject;
        $link = "/meraki/tasks/displayTask/" . $id;

        TaskManager::addNotificationEntry($user[0], $subjectLine, $link);

        return redirect('/meraki/tasks')->with('success', 'Task Updated Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //validate post data
      $this->validate($request, [
          'issuedTo' => 'required',
          'subject' => 'required',
          'description' => 'required',
          'startDate' => 'required',
          'endDate' => 'required'
      ]);

      $taskManager = TaskManager::find($id);
      $taskManager->issued_to = $request->issuedTo;
      $taskManager->subject = $request->subject;
      $taskManager->status = $request->status;
      $taskManager->description = $request->description;
      $taskManager->category = $request->category;
      $taskManager->start_dttm = $request->startDate;
      $taskManager->end_dttm = $request->endDate;
      $taskManager->client = $request->client;
      $taskManager->priority = $request->priority;
      $taskManager->save();
      return redirect('/meraki/tasks')->with('success', 'Task Updated Successfully');
    }

    public function submitTaskForApproval(Request $request, $id) {

        $taskManager = TaskManager::find($id);
        $taskManager->status = "Pending Approval";
        $taskManager->save();
        return redirect('/meraki/tasks')->with('success', 'Task Submitted For Approval Successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function massReadTasks() {

        auth()->user()->unreadNotifications->where('type', 'App\Notifications\UserTasks')->markAsRead();
        return redirect()->back();
    }

    public function completeTask($id) {

        $task = TaskManager::find($id);
        $task->status = "Completed";
        $task->save();

        $userEmail = "";
        if(\Auth::user()->email == $task->issuer) {
          $userEmail = $task->issued_to;
        }
        else {
          $userEmail = $task->issuer;
        }
        $user = User::where(DB::raw("TRIM(email)"), $userEmail)->get();
        $subjectLine = "Mr. " . \Auth::user()->name . " Completed the Task - " . $task->subject;
        $link = "/meraki/tasks/displayTask/" . $id;

        TaskManager::addNotificationEntry($user[0], $subjectLine, $link);

        return redirect('/meraki/tasks')->with('success', 'Task Completed Successfully');
    }
}
