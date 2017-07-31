@extends('layouts.admin')

@section('page_title')

Log

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
                                Log
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href= "{{route('admin.management.logs.create')}}" type="button" class="btn btn-primary waves-effect">+Add</a>

                                   <!-- <input type="text" class="datepicker form-control" placeholder="From Date">

                                    <input type="text" class="datepicker form-control" placeholder="To Date"> -->

                                </div>
                            </div>
                            

                                @if(Session::has('deleted_log'))
                                 <p class="bg-danger">{{Session('deleted_log')}}</p>
                                @endif

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" da>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Document</th>
                                        <th>Business</th>
                                        <th>Received From</th>
                                        <th>Received By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>                         
                                    <tr>
                                        <th>Date</th>
                                        <th>Document</th>
                                        <th>Business</th>
                                        <th>Received From</th>
                                        <th>Received By</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($logs)
                                    @foreach($logs as $log)
                                    <tr>
                                        <td>{{$log->date_received->toDateString()}}</td>
                                        <td>{{$log->document_type->name}}</td>
                                        <td>{{$log->client->company_name}}</td>
                                        <td>{{$log->user->name}}</td>
                                        <td>{{$log->received_from}}</td>
                                        
                                        <td>
                                            <a href="{{route('admin.management.logs.edit', $log->id)}}" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#delete{{$log->id}}"><i class="material-icons">delete</i></button>
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
            @if($logs)
                @foreach($logs as $log)
            <!-- Delete -->
            <div class="modal fade" id="delete{{$log->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete log entry</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                        <form>
                          

                            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminLogsController@destroy', $log->id]]) !!}
                            
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