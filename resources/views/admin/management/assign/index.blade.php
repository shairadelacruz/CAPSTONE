@extends('layouts.admin')

@section('page_title')

Client Assignment

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
                                Client Assignment
                            </h2><br>
                             <!--<div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">


                                    <input type="text" class="datepicker form-control" placeholder="From Date">

                                    <input type="text" class="datepicker form-control" placeholder="To Date">

                                </div>
                            </div>-->
                            

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" da>
                                <thead>
                                
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Employees</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Employees</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($clients)
                                    @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->company_name}}</td>
                                    
                                        <td>

                                            <button type="button" class="btn btn-link waves-effect" data-toggle="modal" data-target="#viewMembers{{$client->id}}">View Employees</button></td>     
                                        <td>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#editAssign{{$client->id}}"><i class="material-icons">create</i></button>
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

           <!-- Edit-->

            <div class="modal fade" id="editAssign{{$client->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Assign</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">

                                {!! Form::open(['method'=>'POST', 'action'=>'AdminClientUserController@store']) !!}
                                
                               
                                {!! Form:: hidden('client_id',$client->id) !!}

                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form:: label('user_id', 'Accountant:') !!}

                                            {{Form::select('user_id',$allUsers,null,array('multiple'=>'multiple','name'=>'user_id[]'))}}

                                           
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


           <!-- View -->
            <div class="modal fade" id="viewMembers{{$client->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Assigned Employees</h4><br>
                        </div>
                        <div class="modal-body">
                            <ul>
                                @foreach ($client->users as $user)
                                
                                <li>{{$user->name}} - {{$user->roles->pluck('label')}}</li>
                                
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                        <form>
                          

                            {!! Form:: submit('OK', ['class'=>'btn btn-link waves-effect']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End View-->
           @endforeach
                @endif

        </div>

	
@stop