<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <strong>EMPLOYEE EVALUATION</strong>
                </h2>
            </div>

        <div class="body">
            <div class="row clearfix">
                <h5 class="col-sm-3"> Employee Name: </h5>
                  <div class="col-sm-9">
                    {{$user->name}}
                  </div>
                  <div class="col-sm-5">
                    <div class = "form-group">
                      {!! Form:: label('fromDate', 'From Date:') !!}
                      {{$start}}
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class = "form-group">
                      {!! Form:: label('toDate', 'To Date:') !!}
                       {{$end}}                    </div>
                  </div>
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
                    @if($tasks)
                    @foreach($tasks as $task)
                    <tr>
                      <td>{{$task->name}}</td>
                      <td class="col-sm-4">{{$task->deadline->toDateString}}</td>
                    </tr>
                    @endforeach
                    @endif
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