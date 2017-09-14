@extends('layouts.admin')

@section('page_title')

Activity Log

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
                                Activity Log
                            </h2><br>

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>User</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>User</th>
                                        <th>Activity</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($activities)
                                    @foreach($activities as $activity)
                                    <tr>
                                        <td>{{$activity->created_at->toDateString()}}</td>
                                        <td>{{$activity->created_at->toTimeString()}}</td>
										<td>{{$activity->user->name}}</td>
										<td>@include ("admin.utilities.activity.types.{$activity->name}")</td>
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
        </div>

	
@stop