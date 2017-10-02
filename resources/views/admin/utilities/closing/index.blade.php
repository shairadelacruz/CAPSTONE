@extends('layouts.admin')

@section('page_title')

Close Transactions

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
                                Closing Transactions
                            </h2><br>
                            @if(Session::has('updated_closing'))
                                 <p class="bg-danger">{{Session('updated_closing')}}</p>
                            @endif
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Company Name</th>
                                        <th>Current Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Code</th>
                                        <th>Company Name</th>
                                        <th>Current Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                
                                @if($clients)
                                    @foreach($clients as $client)
                                     @if($client->closing->where('status', 0)->last())
                                    <tr>
                                        <td>{{$client->code}}{{$client->id}}</td>
                                        <td>{{$client->company_name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($client->closing->where('status', 0)->last()->created_at)->format('m-Y') }}</td>
										<td>
                                            <!--<button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#open{{$client->id}}"><i class="fa fa-folder-open-o" aria-hidden="true"></i></button>-->
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#close{{$client->id}}"><i class="fa fa-times-circle" aria-hidden="true"></i></button>                              
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

            @if($clients)
                @foreach($clients as $client)
            <!-- Edit -->
          <!--  <div class="modal fade" id="open{{$client->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Open Transaction</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">
                                {!! Form::model($client,['method'=>'PATCH', 'action'=>['AdminClosingController@update', $client->id]]) !!}
                                
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('month', 'Month:') !!}
                                            {!! Form:: selectMonth('month',null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('year', 'Year:') !!}
                                            {!! Form:: selectYear('year',Carbon\Carbon::today()->format('Y'), 1900, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form:: submit('SAVE', ['class'=>'btn btn-primary']) !!}
                                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                    </div>
                                 
                                {!! Form::close() !!}
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div> -->
           <!--End Edit --> 
           
            
            <!-- Close-->
            <div class="modal fade" id="close{{$client->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Close</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to close the book for this period?
                        </div>
                        <div class="modal-footer">
                            {!! Form::model($client,['method'=>'PATCH', 'action'=>['AdminClosingController@update', $client->id]]) !!}

                            {{ Form::hidden('client_id', $client->id) }}

                            {{ Form::hidden('closing_id', $client->closing->where('status', 0)->last()->id) }}

                            {!! Form:: submit('DELETE', ['class'=>'btn btn-link waves-effect']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End Close--> 
           @endforeach
            @endif

        </div>

	
@stop