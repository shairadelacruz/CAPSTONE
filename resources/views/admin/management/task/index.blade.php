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

                                   <input type="text" class="datepicker form-control" placeholder="From Date">

                                    <input type="text" class="datepicker form-control" placeholder="To Date">

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
                                        <th>Date</th>
                                        <th>Task</th>
                                        <th>Assigned Accountant</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Task</th>
                                        <th>Assigned Accountant</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($tasks)
                                    @foreach($tasks as $task)
                                    <tr>
                                        <td>{{$task->deadline->toDateString()}}</td>
                                        <td>{{$task->name}}</td>
                                        <td>{{$task->user->name}}</td>
                                        <td>{{$task->status == 0 ? 'Pending' : 'Done'}}</td>                                        
                                        <td>
                                            <a href="{{route('admin.management.task.edit', $task->id)}}" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>

                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteTask{{$task->id}}"><i class="material-icons">delete</i></button>
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
            <!-- Delete -->
            <div class="modal fade" id="deleteTask{{$task->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete Task</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminTasksController@destroy', $task->id]]) !!}

                            {!! Form:: submit('DELETE', ['class'=>'btn btn-link waves-effect']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End Delete--> 
           @endforeach
            @endif
 
        </div>
	
@stop