@extends('layouts.admin')

@section('page_title')

Business Types

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
                                Business Type
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#addBusiness">+Add</button>
                                </div>
                            </div>
                            <!--
                            @if(Session::has('deleted_business'))
                                 <p class="bg-danger">{{Session('deleted_business')}}</p>
                            @endif-->

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Business Type</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Business Type</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($businesses)
                                    @foreach($businesses as $business)
                                    <tr>
                                        <td>{{$business->name}}</td>
                                        <td>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editBusiness{{$business->id}}"><i class="material-icons">create</i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteBusiness{{$business->id}}"><i class="material-icons">delete</i></button>
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
            <div class="modal fade" id="addBusiness" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Add Business Type</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">

                                    {!! Form::open(['method'=>'POST', 'action'=>'AdminBusinessesController@store']) !!}
                                
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('name', 'Business Type:') !!}
                                            {!! Form:: text('name',null, ['class'=>'form-control']) !!}
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
            
            @if($businesses)
            @foreach($businesses as $business)
            <!-- Edit -->
            <div class="modal fade" id="editBusiness{{$business->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Edit Business Type</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">
                                {!! Form::model($business,['method'=>'PATCH', 'action'=>['AdminBusinessesController@update', $business->id]]) !!}
                                
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('name', 'Business Type:') !!}
                                            {!! Form:: text('name',null, ['class'=>'form-control']) !!}
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
           <!--End Edit --> 
           
            
            <!-- Delete-->
            <div class="modal fade" id="deleteBusiness{{$business->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete Business type</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminBusinessesController@destroy', $business->id]]) !!}

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