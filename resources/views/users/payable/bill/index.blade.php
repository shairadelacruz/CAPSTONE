@extends('layouts.admin')

@section('page_title')

Bills

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
                                Bill
                            </h2><br>
                             <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href="bill/create" class="btn btn-primary waves-effect">+Add</a>

                                    @if(Session::has('deleted_bill'))
                                    <p class="bg-danger">{{Session('deleted_bill')}}</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="body table-responsive">
                            <table width="900" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Vendor</th>
                                        <th>Bill Date</th>
                                        <th>Due Date</th>
                                        <th>Due Amount</th>
                                        <th>Balance Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Vendor</th>
                                        <th>Bill Date</th>
                                        <th>Due Date</th>
                                        <th>Due Amount</th>
                                        <th>Balance Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($bills)
                                    @foreach($bills as $bill)
                                    <tr>
                                        <td>@if($bill->reference_no != 0)
                                            {{$bill->reference_no}}
                                            @else
                                            None
                                            @endif
                                        </td>
                                        <td>{{$bill->vendor->name}}</td>
                                        <td>{{$bill->bill_date->toDateString()}}</td>
                                        <td>{{$bill->due_date->toDateString()}}</td>
                                        <td class="right-align-text">{{$bill->amount}}</td>
                                        <td class="right-align-text">{{$bill->balance}}</td>
                                        <td>
                                            @if($bill->balance == 0)
                                            <span class="bg-info lead">Paid</span>
                                            @elseif($bill->due_date < Carbon\Carbon::now() AND $bill->balance > 0)
                                            <span class="bg-danger lead">Overdue</span>
                                            @else
                                            <span class="bg-warning lead">Pay in {{$bill->due_date->diffForHumans()}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href ="bill/{{$bill->id}}/edit" class="btn btn-default btn-xs waves-effect"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteBill{{$bill->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#payBill{{$bill->id}}"><i class="fa fa-money" aria-hidden="true"></i></button>
                                            <a href ="bill/{{$bill->id}}/show" class="btn btn-default btn-xs waves-effect"><i class="fa fa-print" aria-hidden="true"></i></a>
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
            
           @if($bills)
            @foreach($bills as $bill)
            <!-- Delete -->
            <div class="modal fade" id="deleteBill{{$bill->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Void Bill</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to void?
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['method'=>'DELETE', 'action'=>['UserBillsController@destroy', $bill->id, $bill->client_id]]) !!}

                            {!! Form:: submit('VOID', ['class'=>'btn btn-link waves-effect']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End Delete-->

            <!-- Pay -->
            <div class="modal fade" id="payBill{{$bill->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Pay Bill</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">

                                {!! Form::open(['method'=>'POST', 'action'=>['UserBillsController@pay', $bill->id, $bill->client_id]]) !!}

                                    {!! Form:: hidden('client_id', $bill->client_id) !!}    
                                
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('date', 'Date:') !!}
                                            {!! Form:: date('date',null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('amount', 'Amount:') !!}
                                            {!! Form:: number('amount',null, ['class'=>'form-control','step' => '0.01']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('description', 'Description:') !!}
                                            {!! Form:: textarea('description',null, ['class'=>'form-control']) !!}
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
            </div>
           <!--End Pay--> 
           @endforeach
            @endif

        </div>
	
@stop