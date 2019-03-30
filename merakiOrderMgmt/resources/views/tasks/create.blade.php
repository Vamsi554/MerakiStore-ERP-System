@extends('layouts.template')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tasks
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

            <div class="box-body">

              @if(Session::has('success'))
                  <div class="alert alert-success" style="display: inline-block;">
                     {{ Session::get('success') }}
                        @php
                         Session::forget('success');
                        @endphp
                   </div>
               @endif

               <form method="POST" action="/task/addTask" autocomplete="off">
                 <table id="example1" class="table table-bordered table-striped">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <tr class="{{ $errors->has('title') ? 'has-error' : '' }}">
                           <td>Task Title</td>
                           <td>
                               <input type="text" id="title" name="title" size="27"
                               style="width:100%!important" value="{{ old('title') }}">
                               <span class="text-danger">{{ $errors->first('title') }}</span>
                           </td>
                       </tr>

                       <tr class="{{ $errors->has('body') ? 'has-error' : '' }}">
                           <td>Task Body</td>
                           <td>
                               <textarea rows="6" cols="27" id="body" name="body"
                                style="width:100%!important" value="{{ old('body') }}">
                               </textarea>
                               <span class="text-danger">{{ $errors->first('body') }}</span>
                           </td>
                       </tr>
              </table>
              <button class="btn btn-primary" type="submit">Create Task</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
