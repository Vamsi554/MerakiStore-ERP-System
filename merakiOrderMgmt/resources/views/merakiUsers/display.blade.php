@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        User | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            <div class="box-header">
              <h3 class="box-title"> {{ $user->name }} </h3>
            </div>

            <div class="box-body">
             <div class="row">
               <div class="col-md-12">
                 <table class="table table-bordered table-striped">
                   <h4 class="box-title"> User Details </h4>

                       <tr>
                           <td style="width:30%">Email</td>
                           <td>
                             {{ $user->email }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">First Name</td>
                           <td>
                             {{ $user->first_name }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Last Name</td>
                           <td>
                             {{ $user->last_name }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Role</td>
                           <td>
                             {{ $user->role }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Department</td>
                           <td>
                             {{ $user->department }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Contact</td>
                           <td>
                             {{ $user->contact }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Address</td>
                           <td>
                             {{ $user->address }}
                           </td>
                       </tr>

                       <tr>
                           <td style="width:30%">Joining Date</td>
                           <td>
                             {{ date('d-M-Y', strtotime($user->hire_date)) }}
                           </td>
                       </tr>

                  </table>

               </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
