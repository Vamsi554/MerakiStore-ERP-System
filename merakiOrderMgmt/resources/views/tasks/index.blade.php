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
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Task ID</th>
                  <th>Task Title</th>
                  <th>Task Body</th>
                  <th>Task Creation DateTime</th>
                  <th>Task Edit</th>
                  <th>Task Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                  <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->body }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>
                      <a href="/task/updateTask/{{ $task->id }}" class="btn btn-warning ml-2">Update</a>
                    </td>
                    <td>
                      <form action="/task/deleteTask/{{ $task->id }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Delete</button>
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

      <a href="{{ url('/task/createTask') }}" class="btn btn-primary ml-2">Add New Task</a>

    </section>
  </div>

@endsection
