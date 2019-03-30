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
               <form method="POST" class="form-group" action="{{ URL::to('/') }}/meraki/tasks/addTask" autocomplete="off">

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">

                 <div class="row">
                   <div class="col-md-12">
                     <table class="table table-bordered table-striped">
                       <h4 class="box-title"> Task Details </h4>

                           <tr class="{{ $errors->has('issuedTo') ? 'has-error' : '' }}">
                               <td style="width:30%">Assign To</td>
                               <td>
                                 <select class="form-control" style="width: 100%;" id="issuedTo"
                                 name="issuedTo" value="{{ old('issuedTo') }}" required>
                                  @foreach ($users as $user)
                                    <option>{{ $user->email }}</option>
                                  @endforeach
                                 </select>
                                 <span class="text-danger">{{ $errors->first('issuedTo') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('client') ? 'has-error' : '' }}">
                               <td style="width:30%">Client</td>
                               <td>
                                 <input class="form-control" type="text" id="client"
                                 name="client" size="27" style="width:100%!important" value="{{ old('client') }}" required>
                                 <span class="text-danger">{{ $errors->first('client') }}</span>
                               </td>
                           </tr>


                           <tr class="{{ $errors->has('subject') ? 'has-error' : '' }}">
                               <td style="width:30%">Subject</td>
                               <td>
                                 <input class="form-control" type="text" id="subject"
                                 name="subject" size="27" style="width:100%!important" value="{{ old('subject') }}" required>
                                 <span class="text-danger">{{ $errors->first('subject') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('category') ? 'has-error' : '' }}">
                               <td style="width:30%">Category</td>
                               <td>
                                 <input class="form-control" type="text" id="category"
                                 name="category" size="27" style="width:100%!important" value="{{ old('category') }}" required>
                                 <span class="text-danger">{{ $errors->first('category') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('description') ? 'has-error' : '' }}">
                               <td style="width:30%">Description</td>
                               <td>
                                 <textarea rows="4" cols="50" class="form-control" type="text" id="description"
                                 name="description" size="27" style="width:100%!important"
                                 value="{{ old('description') }}" required></textarea>
                                 <span class="text-danger">{{ $errors->first('description') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('priority') ? 'has-error' : '' }}">
                               <td style="width:30%">Priority</td>
                               <td>
                                 <select class="form-control" style="width: 100%;" id="priority"
                                 name="priority" value="{{ old('priority') }}" required>
                                  <option>Lowest</option>
                                  <option>Low</option>
                                  <option>Normal</option>
                                  <option>Medium</option>
                                  <option>High</option>
                                  <option>Highest</option>
                                 </select>
                                 <span class="text-danger">{{ $errors->first('priority') }}</span>
                               </td>
                           </tr>


                           <tr class="{{ $errors->has('startDate') ? 'has-error' : '' }}">
                               <td style="width:30%">Start Date</td>
                               <td>
                                 <input class="form-control" type="date" id="startDate"
                                 name="startDate" size="27" style="width:100%!important" value="{{ old('startDate') }}" required>
                                 <span class="text-danger">{{ $errors->first('startDate') }}</span>
                               </td>
                           </tr>

                           <tr class="{{ $errors->has('endDate') ? 'has-error' : '' }}">
                               <td style="width:30%">End Date</td>
                               <td>
                                 <input class="form-control" type="date" id="endDate"
                                 name="endDate" size="27" style="width:100%!important" value="{{ old('endDate') }}" required>
                                 <span class="text-danger">{{ $errors->first('endDate') }}</span>
                               </td>
                           </tr>

                      </table>

                      <button class="btn btn-primary" type="submit">Assign Task</button>

                   </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
