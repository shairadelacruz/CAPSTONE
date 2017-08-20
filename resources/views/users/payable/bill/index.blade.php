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
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Vendor</th>
                                        <th>Bill Date</th>
                                        <th>Due Date</th>
                                        <th>Due Amount</th>
                                        <th>Balance Amount</th>
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
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($bills)
                                    @foreach($bills as $bill)
                                    <tr>
                                        <td>{{$bill->reference_no}}</td>
                                        <td>{{$bill->vendor_id}}</td>
                                        <td>{{$bill->bill_date}}</td>
                                        <td>{{$bill->due_date}}</td>
                                        <td>{{$bill->amount}}</td>
                                        <td>{{$bill->balancel}}</td>
                                        <td>
                                            <a href ="/edit" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteBill{{$bill->id}}"><i class="material-icons">delete</i></button>
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
                            <h4 class="modal-title" id="smallModalLabel">Delete Bill</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['method'=>'DELETE', 'action'=>['UserBillsController@destroy', $bill->id, $bill->client_id]]) !!}

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