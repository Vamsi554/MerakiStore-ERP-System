@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Task Management
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tasks | Meraki Store</h3>
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
                  <th>ID</th>
                  <th>Subject</th>
                  <th>Issued By</th>
                  <th>Issued To</th>
                  <th>Status</th>
                  <th>Note</th>
                  <th>Update</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php
                  $sNo = 1
                @endphp
                @foreach ($tasks as $task)
                  <tr>
                    <td>{{ $sNo++ }}</td>
                    <td><a href="{{ URL::to('/') }}/meraki/tasks/displayTask/{{ $task->id }}">{{ $task->subject }}</a></td>
                    <td>{{ $task->issuer }}</td>
                    <td>{{ $task->issued_to }}</td>
                    @if($task->status == 'Open')
                      <td><span class="label label-danger">Open</span></td>
                    @endif

                    @if($task->status == 'Pending Approval')
                      <td><span class="label label-warning">Pending Approval</span></td>
                    @endif

                    @if($task->status == 'Completed')
                      <td><span class="label label-success">Completed</span></td>
                    @endif
                    <td>
                      @if($task->status != 'Open' && $task->status != 'Pending Approval')
                        N/A
                      @else
                          <a href="#addTaskNoteModal" class="btn btn-info ml-2" data-toggle="modal" style="padding-right:10px;">Note</a>
                      @endif
                    </td>
                    <td>
                      @if($task->issuer != \Auth::user()->email)
                         N/A
                      @else
                        @if($task->status != 'Completed')
                          <a href="{{ URL::to('/') }}/meraki/tasks/updateTask/{{ $task->id }}" class="btn btn-warning ml-2" style="padding-right:10px;">Update</a>
                        @else
                          N/A
                        @endif
                      @endif
                    </td>
                    @if(\Auth::user()->email == $task->issuer)
                      @if($task->status != 'Open' && $task->status != 'Pending Approval')
                        <td> N/A </td>
                      @else
                        <td>
                          <form method="POST" action="{{ URL::to('/') }}/meraki/tasks/completeTask/{{ $task->id }}" onsubmit="return confirm('Are You Sure You Want To Complete The Task? Action Can\'t Be Reverted!');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-success ml-2" value="Complete">
                          </form>
                        </td>
                      @endif
                    @else
                      <td> N/A </td>
                    @endif
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ URL::to('/') }}/meraki/tasks/addTask" class="btn btn-primary ml-2">Assign Task</a>

      <div class="modal fade" id="addTaskNoteModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" action = "{{ URL::to('/') }}/meraki/tasks/addNote/save/{{ $task->id }}" autocomplete="off">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Add Note </h4>
              </div>
              <div class="modal-body">
                <b>Issued By : </b> {{ $task->issuer }}
                <br><br>
                <b>Issued To : </b> {{ $task->issued_to }}
                <br><br>
                <b>Task : </b> {{ $task->subject }}
                <br><br>
                <b>Details : </b> {{ $task->description }}
                <br><br>
                <b>Note : </b> <br><br>
                <textarea rows="4" cols="50" class="form-control" type="text" id="taskNote"
                name="taskNote" size="27" style="width:100%!important"
                value="{{ old('taskNote') }}" required></textarea>
                <br>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>


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
