@extends('layouts.admin')

@section('page_title')

Bills

@endsection

@extends('includes.form_includes');

@section('content')

        <div class="container-fluid">
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Create Bills
                            </h2><br>
                            <div class="row clearfix js-sweetalert">
                                <div class="col-sm-6">

                                    <div class = "form-group">
                                        {!! Form:: label('ref_no', 'Reference No.:') !!}
                                        {!! Form:: text('ref_no',null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-sm-4">
                                    <div class = "form-group">
                                         {!! Form:: label('date', 'Date:') !!}
                                        {!! Form:: date('date',null, ['class'=>'form-control datepicker']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class = "form-group">
                                        {!! Form:: label('term', 'Terms:') !!}
                                        {!! Form:: number('term',null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>  
                            </div>
                            
                            <div class="row clearfix js-sweetalert">
                                 <div class="col-sm-4">
                                    <div class = "form-group">
                                         {!! Form:: label('due_date', 'Due Date:') !!}
                                        {!! Form:: date('due_date',null, ['class'=>'form-control datepicker']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class = "form-group">
                                        {!! Form:: label('vendor', 'Vendor:') !!}
                                        {!! Form:: select('vendor', [''=>'Choose Vendor'] ,null, ['class'=>'form-control']) !!}
                                    </div>
                                 </div>   
                            </div>


                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Account Title</th>
                        <th>Description</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>VAT Code</th>
                        <th>VAT Amount</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a class="cutForCompute"></a><select>
                            <option>No item</option>
                            <option>Fries</option>
                            </select></td>
                        <td>
                            <select>
                                <option>Office Supplies</option>
                                <option>Accounts Payable</option>
                            </select>
                        </td>
                        <td><span data-prefix>₱</span><span contenteditable>150.00</span></td>
                        <td><span data-prefix>₱</span><span contenteditable>150.00</span></td>
                        <td><span contenteditable>4</span></td>
                        <td><span contenteditable>10</span></td>
                        <td><span data-prefix>₱</span><span>600.00</span></td>
                        <td><span data-prefix>₱</span><span>600.00</span></td>
                    </tr>
                </tbody>
            </table>
            <a class="addForCompute">+</a>
            <table class="balanceForCompute">

                <tr>
                    <th><span contenteditable>Total</span></th>
                    <td><span data-prefix>₱</span><span>00.00</span></td>
                </tr>
                            </table>
                            
                            <button type="button" class="btn bg-blue btn-block btn-lg waves-effect">Save</button>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            

        </div>

	
@stop