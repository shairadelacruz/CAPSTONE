@extends('layouts.user')

@section('page_title')

Cash Disbursement

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
                                Edit Cash Disbursement
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <input type="text" class="form-control" placeholder="Reference No.">
                                    <input type="text" class="datepicker form-control" placeholder="Date">
                                    <input type="text" class="form-control" placeholder="Description">
  
                                   

                                </div>
                            </div>

                        </div>
                        <div class="body table-responsive">
                            <table class="inventoryForCompute table table-bordered table-striped table-hover dataTable">
                <thead>
                    <tr>
                        <th>Account Title</th>
                        <th>Description</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>VAT Code</th>
                        <th>VAT Amount</th>
                        <th>Name</th>

                    </tr>
                </thead>
                                
                <tfoot>
                    <tr>
                        <th> </th>
                        <th> </th>
                        <th>Debit Total</th>
                        <th>Credit Total</th>
                        <th> </th>
                        <th> </th>
                        <th> </th>

                    </tr>
                </tfoot>
                                
                <tbody>
                    <tr>
                        <td>Cash</td>
                        <td><span contenteditable>Describe</span></td>
                        <td><span data-prefix>₱</span><span contenteditable>150.00</span></td>
                        <td><span data-prefix>₱</span><span contenteditable>150.00</span></td>
                        <td>
                            <select>
                                <option>A</option>
                                <option>B</option>
                            </select>
                        </td>
                        <td><span data-prefix>₱</span><span contenteditable>15.00</span></td>
                        <td><span contenteditable>McDollibee</span></td>
                    </tr>
                </tbody>
            </table>
            <a class="addForCompute">+</a>
                      
                            <button type="button" class="btn bgblue btn-block btn-lg waves-effect">Save</button>
                            
                        </div>
                    </div>
                </div>-
            </div>
            <!-- #END# Exportable Table -->
            

        </div>

	
@stop