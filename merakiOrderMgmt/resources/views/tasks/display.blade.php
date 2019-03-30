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
              <h3 class="box-title">Tasks | {{ $task->title }}</h3>
            </div>

            <div class="box-body">
                 <table id="example1" class="table table-bordered table-striped">
                       <tr>
                           <td>Task Title</td>
                           <td>
                               {{ $task->title }}
                           </td>
                       </tr>
                       <tr>
                           <td>Task Body</td>
                           <td>
                               {{ $task->body }}
                           </td>
                       </tr>
              </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
