@extends('layouts.admin')

@section('page_title')

Employee Evaluation

@endsection

@extends('includes.table_includes')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <strong>EMPLOYEE EVALUATION</strong>
                </h2>
                <a href="/admin/management/evaluation/generate" class="btn btn-success pull-right">Generate PDF</a>
            </div>

        <div class="body">
            <div class="row clearfix">
                <h5 class="col-sm-3"> Employee Name: </h5>
                  <div class="col-sm-9">
                    <select class="form-control show-tick" id="emp">
                      <option value="">-- Please select employee --</option>
                      @foreach ($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-5">
                    <div class = "form-group">
                  		{!! Form:: label('fromDate', 'From Date:') !!}
                      {!! Form:: date('fromDate',null, ['class'=>'form-control datepicker']) !!}
                  	</div>
                  </div>
                  <div class="col-sm-5">
                    <div class = "form-group">
                      {!! Form:: label('toDate', 'To Date:') !!}
                      {!! Form:: date('toDate',null, ['class'=>'form-control datepicker']) !!}
                    </div>
                  </div>
                  <button type="button" class="btn btn-success col-sm-1" onclick="getEmpData()">Show Data</button>
                </div>

            <div class="container">
              <div class="body table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>List of Tasks</th>
                      <th>Deadline</th>
                    </tr>
                  </thead>
                  <tbody id="taskdata">
                    <tr>
                      <td></td>
                      <td class="col-sm-4"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="body table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Number of Tasks</th>
                      <th>Completed</th>
                      <th>Revision</th>
                      <th>Pending</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td id="num_task"></td>
                      <td id="comp"></td>
                      <td id="rev"></td>
                      <td id="pend"></td>
                    </tr>
                  </tbody>
                </table>

                
              </div>

            </div>



        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
function getEmpData(){
  $.ajax({
    url: "/getEmpData",
    type: "GET",
    data:{
      "id":$('#emp').val(),
      "fdate":$('#fromDate').val(),
      "tdate":$('#toDate').val(),
    },
    success: function(result){
      $("#taskdata").html(result.tasktablebody);
      $("#num_task").html(result.user_tasks);
      $("#comp").html(result.completed);
      $("#rev").html(result.revision);
      $("#pend").html(result.pending);
    }
  })
}
</script>
@stop
