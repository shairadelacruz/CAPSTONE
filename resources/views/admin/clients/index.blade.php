@extends('layouts.admin')

@section('page_title')

Clients

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
                                Client
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href= "{{route('admin.clients.create')}}" type="button" class="btn btn-primary waves-effect">+Add</a>
                                </div>
                            </div>

                               @if(Session::has('deleted_client'))
                                 <p class="bg-danger">{{Session('deleted_client')}}</p>
                                @endif
                                    @if(Session::has('created_client'))
                                    <br>
                                    <div class="bg-danger">
                                        Do you want to set up your accounts? <br>
                                        <a href="/user/{{Session('created_client')}}/accounting/coa" class="btn btn-danger">Yes</a>
                                        <input class="btn btn-danger" type="button" value="No" onClick="window.location.reload()">
                                    </div>
                                    @endif

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Company Name</th>
                                        <th>Address</th>
                                        <th>Contact Person</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Code</th>
                                        <th>Company Name</th>
                                        <th>Address</th>
                                        <th>Contact Person</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                @if($clients)
                                    @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->code}}{{$client->id}}</td>
                                        <td>{{$client->company_name}}</td>
                                        <td>{{$client->address}}</td>
                                        <td>{{$client->contact_name}}</td>         
                                        <td>
                                            <a href="{{route('admin.clients.edit', $client->id)}}" class="btn btn-default btn-xs waves-effect"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteClients{{$client->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            <button class="btn btn-default btn-xs waves-effect"><i class="fa fa-print" aria-hidden="true"></i></button>
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
            @if($clients)
                @foreach($clients as $client)
 
            <!-- Delete Clients -->
            <div class="modal fade" id="deleteClients{{$client->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete a client</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                          {!! Form::open(['method'=>'DELETE', 'action'=>['AdminClientsController@destroy', $client->id]]) !!}

                            {!! Form:: submit('DELETE', ['class'=>'btn btn-link waves-effect']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End Delete Clients--> 

            @endforeach
         @endif




        </div>

@stop