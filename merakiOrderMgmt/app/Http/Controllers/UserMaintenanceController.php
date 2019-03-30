<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\RetiredUsers;
use App\Notifications\UserActions;
use App\Notifications\UserTasks;
use Illuminate\Support\Facades\Hash;

class UserMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all()->where('retire_date', '==', null);
      if(count($users) > 0) {
          return view('merakiUsers.index', compact('users'));
      }
      else {
          return view('merakiUsers.dummy');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('merakiUsers.create');
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
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:8',
          'hireDate' => 'required',
          'contact' => 'required'
      ]);

      $user = new User();
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->admin = $request->isAdmin;
      $user->first_name = $request->firstName;
      $user->last_name = $request->lastName;
      $user->name = $request->firstName . " " . $request->lastName;
      $user->role = $request->role;
      $user->department = $request->department;
      $user->address = $request->address;
      $user->contact = $request->contact;
      $user->hire_date = date('d-M-Y', strtotime($request->hireDate));

      $user->save();

      $subjectLine = "Mr. " . \Auth::user()->name . " added a New User " . $user->email . ", " . $user->name . " in the System.";
      $link = "/meraki/users/displayUser/" . $user->id;
      User::addNotificationEntry($subjectLine, $link);

      return redirect('/meraki/users')->with('success', 'User Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::find($id);
      return view('merakiUsers.display', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::find($id);
      return view('merakiUsers.edit', compact('user'));
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

      $user = User::find($id);
      $user->first_name = $request->firstName;
      $user->last_name = $request->lastName;
      $user->name = $request->firstName . " " . $request->lastName;
      $user->role = $request->role;
      $user->department = $request->department;
      $user->address = $request->address;
      $user->contact = $request->contact;
      $user->hire_date = date('d-M-Y', strtotime($request->hireDate));
      $user->save();

      $subjectLine = "Mr. " . \Auth::user()->name . " Updated User Details for " . $user->email . ", " . $user->name . "";
      $link = "/meraki/users/displayUser/" . $id;
      User::addNotificationEntry($subjectLine, $link);

      return redirect('/meraki/users')->with('success', 'User Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $retiredUser = new RetiredUsers();
        $retiredUser->user_id = $id;
        $retiredUser->email = $user->email;
        $retiredUser->admin = $user->admin;
        $retiredUser->first_name = $user->first_name;
        $retiredUser->last_name = $user->last_name;
        $retiredUser->role = $user->role;
        $retiredUser->department = $user->department;
        $retiredUser->address = $user->address;
        $retiredUser->contact = $user->contact;
        $retiredUser->hire_date = $user->hire_date;
        $retiredUser->retire_date = \Carbon\Carbon::now("Asia/Kolkata")->format("d-M-Y");
        $retiredUser->save();

        $user->delete();

        $subjectLine = "Mr. " . \Auth::user()->name . " Retired the User - " . $user->email . "";
        $link = "/meraki/users";
        User::addNotificationEntry($subjectLine, $link);

        return redirect('/meraki/users')->with('success', 'User Deleted Successfully');
    }

    public function massReadNotifications() {

        auth()->user()->unreadNotifications->where('type', 'App\Notifications\UserActions')->markAsRead();
        return redirect()->back();
    }
}
