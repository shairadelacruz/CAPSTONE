@extends('layouts.admin')

@section('page_title')

Invoice

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
                                Invoice
                            </h2><br>
                             <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href="invoice/create" class="btn btn-primary waves-effect">+Add</a>

                                    @if(Session::has('deleted_invoice'))
                                    <p class="bg-danger">{{Session('deleted_invoice')}}</p>
                                    @endif
                                    
                                    <div class = "form-group">
                                         {!! Form:: label('from_date', 'From Date:') !!}
                                        {!! Form:: date('date',null, ['class'=>'form-control datepicker']) !!}
                                    </div>

                                    <div class = "form-group">
                                         {!! Form:: label('to_date', 'To Date:') !!}
                                        {!! Form:: date('date',null, ['class'=>'form-control datepicker']) !!}
                                    </div>
                                                          
                                    <div class = "form-group">
                                        {!! Form:: label('customer', 'Customers:') !!}
                                        {!! Form:: select('customer', [''=>'Choose Customer'] ,null, ['class'=>'form-control']) !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Customer</th>
                                        <th>Invoice Date</th>
                                        <th>Due Date</th>
                                        <th>Amount Due</th>
                                        <th>Balance Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Customer</th>
                                        <th>Invoice Date</th>
                                        <th>Due Date</th>
                                        <th>Due Amount</th>
                                        <th>Balance Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($invoices)
                                    @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{$invoice->reference_no}}</td>
                                        <td>{{$invoice->customer_id}}</td>
                                        <td>{{$invoice->invoice_date}}</td>
                                        <td>{{$invoice->due_date}}</td>
                                        <td>{{$invoice->amount}}</td>
                                        <td>{{$invoice->balancel}}</td>
                                        <td>
                                            <a href ="#" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteInvoice"><i class="material-icons">delete</i></button>
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
            
            <!-- Delete Invoice -->

            <div class="modal fade" id="deleteInvoice" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete an Invoice</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect">DELETE</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>
           <!--End Delete Bills--> 

        </div>

	
@stop