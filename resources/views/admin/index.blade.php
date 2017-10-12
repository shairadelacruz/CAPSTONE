@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row clearfix">
        <!-- Profile -->
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons"></i>
                    </div>
                    <div class="content">
                        <div class="text">TODAY'S DATE</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{Carbon\Carbon::now()->toDateString()}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons"></i>
                    </div>
                    <div class="content">
                        <div class="text">PENDING TASKS</div>
                        <div class="number count-to" data-from="0" data-to="10" data-speed="15" data-fresh-interval="1">{{ Auth::user()->tasks()->where('status', 0)->get()->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons"></i>
                        </div>
                        <div class="content">
                            <div class="text">CLIENTS</div>
                            <div class="number count-to" data-from="0" data-to="30" data-speed="1000" data-fresh-interval="20">{{ Auth::user()->clients->count() }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons"></i>
                        </div>
                        <div class="content">
                            <div class="text">EFFICIENCY</div>
                            <div class="number count-to" data-from="0" data-to="80" data-speed="15" data-fresh-interval="5">80%</div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- #END# Profile -->
        <!-- Info -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-cyan">
                    <div class="m-b--35 font-bold" style="text-align: center;">{{ Auth::user()->name }}</div>
                    <div>
                        <img class="img-responsive" src="../../../public/plugins/ckeditor/plugins/smiley/images/heart.png" alt="" width="75">
                    </div>
                    <ul class="dashboard-stat-list">
                        <li>
                                NAME
                            <span class="pull-right"><b>{{ Auth::user()->name }}</b></span>
                        </li>
                        <li>
                                ROLE
                            <span class="pull-right"><b>{{ Auth::user()->roles->first()->label }}</b></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <!-- #END# Info -->
    </div>
    
        <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Recent Activity
                    </h2><br>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">View all tasks</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="list-group">
                    @if($activities)
                    @foreach($activities as $activity)
                      <a href="#" class="list-group-item">@include ("admin.utilities.activity.types.{$activity->name}") {{$activity->created_at->diffForHumans()}}</a>
                    @endforeach
                    @else
                    <a class="list-group-item">No activity</a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>

@stop