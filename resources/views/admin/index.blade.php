@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="block-header">
    	<h2>{{ Auth::user()->name }}</h2>
    </div>
    <div class="row clearfix">
        <!-- Profile -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="body bg-light-green">
                    <div>
                    	<img src="../images/thumb/thumb-15.jpg">
                	</div>
                    <ul class="dashboard-stat-list">
                        <li>
                        		NAME
                        	<span class="pull-right"><b>{{ Auth::user()->name }}</b></span>
                        </li>
                        <li>
                                BIRTHDAY
                            <span class="pull-right"><b>03 June 1980</b></span>
                        </li>
                        <li>
                                EMPLOYEE ID
                            <span class="pull-right"><b>2010-00003-AMY-0</b></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #END# Profile -->
        <!-- Calendar -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="body bg-cyan">
                    <div class="m-b--35 font-bold">CALENDAR</div>
                </div>
            </div>
        </div>
    <!-- #END# Calendar -->
    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        TASKS
                    </h2><br>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">View all tasks</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body table-responsive">
                    <table class="table table-hover dashboard-task-infos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="#">Assign tasks to team</a></td>
                                <td><span class="glyphicon glyphicon-check"></span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="#">Review journal 24601</a></td>
                                <td><span class="glyphicon glyphicon-check"></span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="#">Assign client Yellow Submarine to team</a></td>
                                <td><span class="glyphicon glyphicon-check"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    	</div>
    </div>
    <!-- #END# Exportable Table -->
</div>

@stop