@extends('layouts.admin')

@section('page_title')

Item

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
                                Item
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#addItem">+Add</button>
                                </div>
                            </div>

                                @if(Session::has('deleted_item'))
                                 <p class="bg-danger">{{Session('deleted_item')}}</p>
                                @endif

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                @if($items)
                                    @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->price}}</td>
                                        
                                        <td>
                                           <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editItem{{$item->id}}"><i class="material-icons">create</i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteItem{{$item->id}}"><i class="material-icons">delete</i></button>
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

            <!-- Add-->
            <div class="modal fade" id="addItem" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Add Item</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">

                                {!! Form::open(['method'=>'POST', 'action'=>['UserItemsController@store', $client_id]]) !!}

                                    {!! Form:: hidden('client_id', $client_id) !!}    
                                
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('name', 'Name:') !!}
                                            {!! Form:: text('name',null, ['class'=>'form-control']) !!}
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
                                            {!! Form:: label('price', 'Price:') !!}
                                            {!! Form:: number('price',null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('coa_id', 'Account:') !!}
                                            {!! Form:: select('coa_id', [''=>'Choose Options'] + $coas ,null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('vat_id', 'VAT Code:') !!}
                                            {!! Form:: select('vat_id', [''=>'Choose Options'] + $vats ,null, ['class'=>'form-control']) !!}
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



            @if($items)
                @foreach($items as $item)
            <!-- Edit -->
            <div class="modal fade" id="editItem{{$item->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Edit Item</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">
                                    {!! Form::model($item,['method'=>'PATCH', 'action'=>['UserItemsController@update',$item->id,$client_id]]) !!}
                                
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('name', 'Name:') !!}
                                            {!! Form:: text('name',null, ['class'=>'form-control']) !!}
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
                                            {!! Form:: label('price', 'Price:') !!}
                                            {!! Form:: number('price',null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('coa_id', 'Account:') !!}
                                            {!! Form:: select('coa_id', [''=>'Choose Options'] + $coas ,null, ['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('vat_id', 'VAT Code:') !!}
                                            {!! Form:: select('vat_id', [''=>'Choose Options'] + $vats ,null, ['class'=>'form-control']) !!}
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
            <div class="modal fade" id="deleteItem{{$item->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete Item</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['method'=>'DELETE', 'action'=>['UserItemsController@destroy', $item->id, $item->client_id]]) !!}

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