@extends('layouts.admin')

@section('page_title')

Task

@endsection

@extends('includes.table_includes');

@section('content')

        <div class="container-fluid">
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Task
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href= "{{route('admin.management.task.create')}}" type="button" class="btn btn-primary waves-effect">+Add</a>

                                </div>
                            </div>
                            
                                @if(Session::has('deleted_task'))
                                 <p class="bg-danger">{{Session('deleted_task')}}</p>
                                @endif

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" da>
                                <thead>

                                    <tr>
                                        <th>Task</th>
                                        <th>Date</th>
                                        <th>Deadline</th>
                                        <th>Assigned Accountant</th>
                                        <th>Documents</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Task</th>
                                        <th>Date</th>
                                        <th>Deadline</th>
                                        <th>Assigned Accountant</th>
                                        <th>Documents</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($tasks)
                                    @foreach($tasks as $task)
                                    <tr>
                                        <td>{{$task->name}}</td>
                                        <td>{{$task->created_at->toDateString()}}</td>
                                        <td>{{$task->deadline->toDateString()}}</td>
                                        <td>{{$task->user->name}}</td>
                                        <td>

                                            <button type="button" class="btn btn-link waves-effect" data-toggle="modal" data-target="#viewDocuments{{$task->id}}">View Documents</button></td>     
                                        </td>
                                        <td>
                                        @if($task->status == 0) Pending
                                        @endif
                                        @if($task->status == 1) Done
                                        @endif
                                        @if($task->status == 2) For Quality Assurance
                                        @endif</td>                                        
                                        <td>
                                        {!! Form::open(['method'=>'POST', 'action'=>'UserTasksController@store']) !!}
                                        <input type="hidden" name="task" value="{{$task->id}}">
                                        <button type="submit" class="btn btn-default btn-xs waves-effect">
                                        <i class="material-icons">play_arrow</i>
                                        </button>
                                            
                                        {!! Form::close() !!}

                                        
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#status{{$task->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            @if($tasks)
                @foreach($tasks as $task)
            <!-- Update -->
            <div class="modal fade" id="status{{$task->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Update Status</h4><br>
                        </div>
                        <div class="modal-body">
                        {!! Form::model($task,['method'=>'PATCH', 'action'=>['UserTasksController@update', $task->id]]) !!}

                            {!! Form:: label('status', 'Status:') !!}

                            {!! Form:: select('status', array(0=>'Pending', 1=>'Done', 2=>'For Quality Assurance'), null, ['class'=>'chosen-select']) !!}
                        </div>
                        <div class="modal-footer">
                            

                            {!! Form:: submit('SAVE', ['class'=>'btn btn-primary']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End Update--> 

            <!-- View -->
            <div class="modal fade" id="viewDocuments{{$task->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Assigned Documents</h4><br>
                        </div>
                        <div class="modal-body">
                            <table style="width:100%">
                              <tr>
                                <th>Document</th>
                                <th>Reference No.</th> 
                                <th>Type</th>
                              </tr>
                                @foreach ($task->log as $log)
                                
                                <tr>
                                    <td><a href="{{asset('images/' . $log->document_path) }}" data-sub-html="Demo Description">
                                        <img class="img-responsive" src="{{asset('images/' . $log->document_path) }}" alt="" class="img-responsive" width="75">
                                    </a>
                                    </td>
                                    <td>{{$log->reference_no}}</td>
                                    <td>{{$log->document_type->name}}</td>
                                    
                                </tr>

                                @endforeach
                             </table>  

                                
                        </div>
                        <div class="modal-footer">
                        <form>
                          

                            {!! Form:: submit('OK', ['class'=>'btn btn-link waves-effect']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End View-->
           @endforeach
            @endif
 
        </div>
	
@stop