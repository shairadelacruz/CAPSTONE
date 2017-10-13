
    <h1> Employee Evaluation </h1>
    <h2>  </h2>
    <h3>  </h3>

    <div class="container">

 <div class="body table-responsive">
    <table id="datatable-fixed-header"  class="table table-bordered table-striped table-condensed table-hover table-responsive" align="center" style="width:100%">
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

