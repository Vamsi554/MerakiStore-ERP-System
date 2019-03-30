@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tasks | Meraki Store
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Task Management </h3>
            </div>

            <div class="box-body">
               <div class="row">
                   <div class="col-md-12">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> Task Details </h4>
                           <tr>
                               <td style="width:30%">Assign To</td>
                               <td>
                                 {{ $task->issued_to }}
                               </td>
                           </tr>
                           <tr>
                               <td style="width:30%">Assignee</td>
                               <td>
                                 {{ $task->issuer }}
                               </td>
                           </tr>
                           <tr>
                               <td style="width:30%">Client</td>
                               <td>
                                 {{ $task->client }}
                               </td>
                           </tr>
                           <tr>
                               <td style="width:30%">Subject</td>
                               <td>
                                 {{ $task->subject }}
                               </td>
                           </tr>
                           <tr>
                               <td style="width:30%">Category</td>
                               <td>
                                 {{ $task->category }}
                               </td>
                           </tr>
                           <tr>
                               <td style="width:30%">Description</td>
                               <td>
                                 {{ $task->description }}
                               </td>
                           </tr>
                           <tr>
                               <td style="width:30%">Priority</td>
                               <td>
                                 {{ $task->priority }}
                               </td>
                           </tr>
                           <tr>
                               <td style="width:30%">Start Date</td>
                               <td>
                                 {{ date('d-M-Y', strtotime($task->start_dttm)) }}
                               </td>
                           </tr>
                           <tr>
                               <td style="width:30%">End Date</td>
                               <td>
                                 {{ date('d-M-Y', strtotime($task->end_dttm)) }}
                               </td>
                           </tr>
                      </table>

                      @if(count($taskNotes) > 0)
                        <b class="timeline-body"> Comments </b>
                        <br><br>
                        <ul>
                        @foreach ($taskNotes as $commentLine)
                            <li> <b> On {{ $commentLine->created_at->setTimezone("Asia/Kolkata")->format("d-M-Y h:i A") }}, Mr. {{ $commentLine->user_name }} Added : </b> {{ $commentLine->notes }}</li>
                            <br><br>
                        @endforeach
                        </ul>
                      @endif

                      @if($task->status != 'Completed')
                        <form method="POST" action="{{ URL::to('/') }}//meraki/tasks/submit/approval/{{ $task->id }}" onsubmit="return confirm('Do You Really Want To Submit the Task for Approval?');">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button class="btn btn-warning ml-2" type="submit">SUBMIT FOR APPROVAL</button>
                        </form>
                      @endif

                   </div>
                 </div>
               </div>
             </div>
           </div>
         </section>
       </div>

@endsection
