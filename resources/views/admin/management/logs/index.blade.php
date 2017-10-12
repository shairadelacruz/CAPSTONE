@extends('layouts.admin')

@section('page_title')

Log

@endsection

@extends('includes.gallery_includes');

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

                                   <input id="min" type="date" class="datepicker form-control" placeholder="From Date">

                                    <input id="max" type="date" class="datepicker form-control" placeholder="To Date">

                                </div>
                            </div>
                            

                                @if(Session::has('deleted_log'))
                                 <p class="bg-danger">{{Session('deleted_log')}}</p>
                                @endif

                        </div>
                        <div class="body table-responsive">
                            <table id="tableLog" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Document</th>
                                        <th>Reference No.</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Client</th>
                                        <th>Received From</th>
                                        <th>Received By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>                         
                                    <tr>
                                        <th>Document</th>
                                        <th>Reference No.</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Client</th>
                                        <th>Received From</th>
                                        <th>Received By</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($logs)
                                    @foreach($logs as $log)
                                    <tr>
                                    

                                        <td><a href="{{asset('images/' . $log->document_path) }}" data-sub-html="Demo Description">
                                        <img class="img-responsive" src="{{asset('images/' . $log->document_path) }}" alt="" class="img-responsive" width="75">
                                        </a></td>
                                        <td>{{$log->reference_no}}</td>
                                        <td>{{$log->date_received->toDateString()}}</td>
                                        <td>{{$log->document_type->name}}</td>
                                        <td>{{$log->client->company_name}}</td>
                                        <td>{{$log->received_from}}</td>
                                        <td>{{$log->user->name}}</td>
                                        
                                        <td>
                                            <a href="{{route('admin.management.logs.edit', $log->id)}}" class="btn btn-default btn-xs waves-effect"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteLog{{$log->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
            <div class="modal fade" id="deleteLog{{$log->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete Log</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
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

@section('scripts')

    <!-- Jquery DataTable Plugin Js -->
            <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
          
        /* Add event listeners to the two range filtering inputs */
        $('#min, #max').keyup( function() {
            table.draw();
        } );
    } );
</script>
    <script type="text/javascript">
    function wow(){
        alert('hi');
    }
</script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{asset('/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!--custom-->
    <script src="{{asset('js/pages/tables/jquery-datatable.js') }}"></script>

@endsection

	
@stop