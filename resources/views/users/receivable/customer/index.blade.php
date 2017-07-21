@extends('layouts.user')

@section('page_title')

Customer

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
                                Customer
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href= "vendor/create" type="button" class="btn btn-primary waves-effect">+Add</a>
                                </div>
                            </div>

                                <!--@if(Session::has('deleted_customer'))
                                 <p class="bg-danger">{{Session('deleted_customer')}}</p>
                                @endif-->

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Balance</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Balance</th>
										<th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                <!--@if($customer)
									@foreach($vendors as $vendor)
                                    <tr>
										<td>{{$vendor->name}}</td>
										<td>{{$vendor->email}}</td>
										<td>{{$vendor->phone}}</td>
										<td>{{$vendor->balance}}</td>-->
										
                                        <td>
                                            <a href="#" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deletevendor{{$vendor->id}}"><i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>
                                    <!--@endforeach
                                @endif-->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->


        </div>

	
@stop