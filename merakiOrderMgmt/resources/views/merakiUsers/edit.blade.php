@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Users | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> User Update Form </h3>
            </div>

            <div class="box-body">
               <form method="POST" class="form-group" action="{{ URL::to('/') }}/meraki/users/updateUser/{{ $user->id }}" autocomplete="off">

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">

                 <div class="row">
                   <div class="col-md-12">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> User Details </h4>

                           <tr class="{{ $errors->has('email') ? 'has-error' : '' }}">
                               <td style="width:30%">Email</td>
                               <td>
                                 <input class="form-control" type="email" id="email"
                                 name="email" size="27" style="width:100%!important" value="{{ $user->email }}" readonly>
                                 <span class="text-danger">{{ $errors->first('email') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('firstName') ? 'has-error' : '' }}">
                               <td style="width:30%">First Name</td>
                               <td>
                                 <input class="form-control" type="text" id="firstName"
                                 name="firstName" size="27" style="width:100%!important" value="{{ $user->first_name }}">
                                 <span class="text-danger">{{ $errors->first('firstName') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('lastName') ? 'has-error' : '' }}">
                               <td style="width:30%">Last Name</td>
                               <td>
                                 <input class="form-control" type="text" id="lastName"
                                 name="lastName" size="27" style="width:100%!important" value="{{ $user->last_name }}">
                                 <span class="text-danger">{{ $errors->first('lastName') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('role') ? 'has-error' : '' }}">
                               <td style="width:30%">Role</td>
                               <td>
                                 <input class="form-control" type="text" id="role"
                                 name="role" size="27" style="width:100%!important" value="{{ $user->role }}">
                                 <span class="text-danger">{{ $errors->first('role') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('department') ? 'has-error' : '' }}">
                               <td style="width:30%">Department</td>
                               <td>
                                 <input class="form-control" type="text" id="department"
                                 name="department" size="27" style="width:100%!important" value="{{ $user->department }}">
                                 <span class="text-danger">{{ $errors->first('department') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('address') ? 'has-error' : '' }}">
                               <td style="width:30%">Address</td>
                               <td>
                                 <input class="form-control" type="text" id="address"
                                 name="address" size="27" style="width:100%!important" value="{{ $user->address }}">
                                 <span class="text-danger">{{ $errors->first('address') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('contact') ? 'has-error' : '' }}">
                               <td style="width:30%">Contact</td>
                               <td>
                                 <input class="form-control" type="number" id="contact"
                                 name="contact" size="27" style="width:100%!important" value="{{ $user->contact }}" required>
                                 <span class="text-danger">{{ $errors->first('contact') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('hireDate') ? 'has-error' : '' }}">
                               <td style="width:30%">Hire Date</td>
                               <td>
                                 <input class="form-control" type="date" id="hireDate"
                                 name="hireDate" size="27" style="width:100%!important" value="{{ $user->hire_date }}" required>
                                 <span class="text-danger">{{ $errors->first('hireDate') }}</span>
                               </td>
                           </tr>

                      </table>

                      <button class="btn btn-primary" type="submit">Update User</button>

                   </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
