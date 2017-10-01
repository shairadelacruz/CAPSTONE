@extends('layouts.admin')

@section('page_title')

COA

@endsection

@extends('includes.table_includes')

@section('content')

        <div class="container-fluid">
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Chart of Accounts
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#addCoa">+Add</button>
                                </div>
                            </div>

                            @if(Session::has('deleted_coa'))
                                 <p class="bg-danger">{{Session('deleted_coa')}}</p>
                            @endif

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Account</th>
                                        <th>Description</th>
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Category</th>
                                        <th>Account</th>
                                        <th>Description</th>
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($coas)
                                    @foreach($coas as $coa)
                                    <tr>

                                        <td>{{$coa->coacategory->name}}</td>
                                        <td>{{$coa->name}}</td>
                                        <td>{{$coa->description}}</td>
                                        <td>{{$coa->debitPartner($client_id)}}</td>
                                        <td>{{$coa->creditPartner($client_id)}}</td>
                                        <td>{{$coa->journals_details->sum('debit') - $coa->journals_details->sum('credit')}}</td> 
                                        <td>
                                            @if($coa->is_generic == 1)
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editCoa{{$coa->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            @endif
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteCoa{{$coa->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

            <!-- Add -->
            <div class="modal fade" id="addCoa" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Add Account</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">

                                    {!! Form::open(['method'=>'POST', 'action'=>['UserCoasController@store', $client_id]]) !!}

                                    {!! Form:: hidden('client_id', $client_id) !!}

                                    {!! Form:: hidden('is_generic', 1) !!} 
                                
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('name', 'Account Name:') !!}
                                            {!! Form:: text('name',null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('coacategory_id', 'Category:') !!}

                                            {!! Form:: select('coacategory_id', array(1=>'Asset', 2=>'Liability', 3=>'Expense', 4=>'Revenue', 5=>'Equity' ), null, ['class'=>'form-control show-tick chosen-select']) !!}

                                        </div>
                                    </div>
                                    
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('description', 'Description:') !!}
                                            {!! Form:: textarea('description',null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('debit_partner', 'Partner Debit:') !!}



                                            {!! Form:: select('debit_partner', [''=>'Choose Options'] + $coaselect ,null, ['class'=>'form-control chosen-select']) !!}

                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('credit_partner', 'Partner Credit:') !!}

                                            {!! Form:: select('credit_partner', [''=>'Choose Options'] + $coaselect ,null, ['class'=>'form-control chosen-select']) !!}

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

           <!--End Add--> 

           @if($coas)
            @foreach($coas as $coa)

                        <!-- Edit -->
            <div class="modal fade" id="editCoa{{$coa->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Edit Account</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">
                            @include('includes.form_error')
                                {!! Form::model($coa,['method'=>'PATCH', 'action'=>['AdminCoasController@update', $coa->id]]) !!}

            
                                
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('name', 'Account Name:') !!}
                                            {!! Form:: text('name',null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('coacategory_id', 'Category:') !!}
                                            {!! Form:: select('coacategory_id', array(1=>'Asset', 2=>'Liability', 3=>'Expense', 4=>'Revenue', 5=>'Equity' ), null, ['class'=>'form-control show-tick']) !!}
                                        </div>
                                    </div>
                                    
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('description', 'Description:') !!}
                                            {!! Form:: textarea('description',null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('debit_partner', 'Partner Debit:') !!}

                                            {!! Form:: select('debit_partner', [''=>'Choose Options'] + $coaselect ,null, ['class'=>'form-control chosen-select']) !!}



                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('credit_partner', 'Partner Credit:') !!}

                                            {!! Form:: select('credit_partner', [''=>'Choose Options'] + $coaselect ,null, ['class'=>'form-control chosen-select']) !!}

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
           <!--End Edit--> 

                       <!-- Delete -->
            <div class="modal fade" id="deleteCoa{{$coa->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete Account</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['method'=>'DELETE', 'action'=>['UserCoasController@destroy',$client_id, $coa->id]]) !!}

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