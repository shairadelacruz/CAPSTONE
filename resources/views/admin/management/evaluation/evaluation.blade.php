@extends('layouts.admin')

@section('page_title')

Employee Evaluation

@endsection

@extends('includes.table_includes')

@section('content')

<h1> Employee Evaluation </h1>
<a href="/admin/management/evaluation/generate" class="btn btn-success">Generate PDF</a>
<hr>
<hr>

<div class="container">
  <div class="body table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Employee</th>
          <th>Number of Task</th>
          <th>On time</th>
          <th>Missed Deadlines</th>
          <th>Revision</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{$user->name}}</td>
          <td>{{$user->tasks->count()}}</td>
          <td>{{$user->tasks->where('status',1)->count()}}</td>
          <td>{{$user->tasks->where('deadline', '<', 'updated_at')->count()}}</td>
          <td>{{$user->tasks->sum('revisions')}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


@stop
