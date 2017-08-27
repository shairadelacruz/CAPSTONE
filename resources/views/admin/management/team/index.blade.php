@extends('layouts.admin')

@section('page_title')

Team Assignment

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
                                Team Assignment
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href= "{{route('admin.management.team.create')}}" type="button" class="btn btn-primary waves-effect">+Add</a>

                                    <!--<input type="text" class="datepicker form-control" placeholder="From Date">

                                    <input type="text" class="datepicker form-control" placeholder="To Date">-->

                                </div>
                            </div>

                            @if(Session::has('deleted_team'))
                                 <p class="bg-danger">{{Session('deleted_team')}}</p>
                            @endif

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" da>
                                <thead>
                                    <tr>
                                        <th>Team</th>
                                        <th>Team Leader</th>
                                        <th>Employees</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Team</th>
                                        <th>Team Leader</th>
                                        <th>Employees</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($teams)
                                    @foreach($teams as $team)
                                    <tr>
                                        <td>{{$team->name}}</td>
                                        <td>{{$team->user->name}}</td>
                                        <td><button type="button" class="btn btn-link waves-effect" data-toggle="modal" data-target="#viewMembers{{$team->id}}">View Employees</button></td>     
                                        <td>
                                            <a href="{{route('admin.management.team.edit', $team->id)}}" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteLogEntry"><i class="material-icons">delete</i></button>
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
            @if($teams)
                @foreach($teams as $team)
            <!-- Delete -->
            <div class="modal fade" id="deleteLogEntry" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete log entry</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminTeamsController@destroy', $team->id]]) !!}
                          

                            {!! Form:: submit('DELETE', ['class'=>'btn btn-link waves-effect']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End Delete-->

           <!-- View -->
            <div class="modal fade" id="viewMembers{{$team->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Assigned Employees</h4><br>
                        </div>
                        <div class="modal-body">
                            <ul>
                                @foreach ($team->users as $user)
                                <li>{{$user->name}}</li>
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