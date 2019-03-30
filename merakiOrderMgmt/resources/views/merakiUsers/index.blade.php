@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Users
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users | Meraki Store</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if(Session::has('success'))
                  <div id="alertMsg" class="alert alert-success" style="display: inline-block;">
                     {{ Session::get('success') }}
                        @php
                         Session::forget('success');
                        @endphp
                   </div>
               @endif
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Email</th>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Contact</th>
                  <th>Join Date</th>
                  <th>Update</th>
                  <th>View</th>
                  <th>Retire</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role  }} <br> {{ $user->department }}</td>
                    <td>{{ $user->contact }}</td>
                    <td>{{ date('d-M-Y', strtotime($user->hire_date)) }}</td>
                    <td>
                      <a href="{{ URL::to('/') }}/meraki/users/updateUser/{{ $user->id }}" class="btn btn-warning ml-2">Update</a>
                    </td>
                    <td>
                      <a href="{{ URL::to('/') }}/meraki/users/displayUser/{{ $user->id }}" class="btn btn-info ml-2">View</a>
                    </td>
                    <td>
                      <form method="POST" action="{{ URL::to('/') }}/meraki/users/deleteUser/{{ $user->id }}" onsubmit="return confirm('Are You Sure You Want To Delete The User? Action Can\'t Be Reverted!');">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger ml-2" value="Retire">
                      </form>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ URL::to('/') }}/meraki/users/addUser" class="btn btn-primary ml-2">Add User</a>

    </section>
  </div>

@endsection

@section('customJs')

<script type="text/javascript">

  $(document).ready(function() {

      $("#alertMsg").delay(5000).fadeOut();
  });
</script>
@endsection
