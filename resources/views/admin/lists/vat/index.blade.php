@extends('layouts.admin')

@section('page_title')

VAT

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
                                VAT CODES
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#addVAT">+Add</button>
                                </div>
                            </div>
                            @include('includes.form_error')
                            @if(Session::has('deleted_vat'))
                                 <p class="bg-danger">{{Session('deleted_vat')}}</p>
                            @endif

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>VAT Code</th>
                                        <th>Rate</th>
                                        <th>Description</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>VAT Code</th>
                                        <th>Rate</th>
                                        <th>Description</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($vats)
                                    @foreach($vats as $vat)
                                    <tr>
                                        <td>{{$vat->vat_code}}</td>
                                        <td>{{$vat->rate}}</td>
                                        <td>{{$vat->description}}</td>  
                                        <td>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editVAT{{$vat->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteVAT{{$vat->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
                
            
            <!-- Add VAT -->
            <div class="modal fade" id="addVAT" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Add VAT Code</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">

                                    {!! Form::open(['method'=>'POST', 'action'=>'AdminVatsController@store']) !!}
                                
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('vat_code', 'VAT Code:') !!}
                                            {!! Form:: text('vat_code',null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('rate', 'Rate:') !!}
                                            {!! Form:: number('rate',null, ['class'=>'form-control','step' => '0.01']) !!}
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

           <!--End Add VAT--> 
            
            @if($vats)
            @foreach($vats as $vat)
            <!-- Edit VAT -->
            <div class="modal fade" id="editVAT{{$vat->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Edit VAT Code</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">
                                {!! Form::model($vat,['method'=>'PATCH', 'action'=>['AdminVatsController@update', $vat->id]]) !!}
                                
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('vat_code', 'VAT Code:') !!}
                                            {!! Form:: text('vat_code',null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('rate', 'Rate:') !!}
                                            {!! Form:: number('rate',null, ['class'=>'form-control','step' => '0.01']) !!}
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
           <!--End Edit VAT--> 
           
            
            <!-- Delete VAT -->
            <div class="modal fade" id="deleteVAT{{$vat->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete VAT code</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminVatsController@destroy', $vat->id]]) !!}

                            {!! Form:: submit('DELETE', ['class'=>'btn btn-link waves-effect']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End Delete VAT--> 
           @endforeach
            @endif

        </div>


@stop