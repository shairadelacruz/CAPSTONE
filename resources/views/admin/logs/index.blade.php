@extends('layouts.admin')

@section('page_title')

Log

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
                                Log
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#addLogEntry">+Add</button>

                                    <input type="text" class="datepicker form-control" placeholder="From Date">

                                    <input type="text" class="datepicker form-control" placeholder="To Date">

                                </div>
                            </div>
                            

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" da>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Document</th>
                                        <th>Business</th>
                                        <th>Received From</th>
                                        <th>Received By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Document</th>
                                        <th>Business</th>
                                        <th>Received From</th>
                                        <th>Received By</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>June 5 2017</td>
                                        <td>09:21 AM</td>
                                        <td>Invoice - 0101</td>
                                        <td>Armed Detective Agency</td>
                                        <td>Dazai Osamu</td>
                                        <td>Hyakuya Yuuichirou</td>     
                                        <td>
                                            <a href="" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteLogEntry"><i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>January 1 2014</td>
                                        <td>11:03 AM</td>
                                        <td>Receipt - 3002</td>
                                        <td>Port Mafia</td>
                                        <td>Nakahara Chuuya</td>
                                        <td>Hyakuya Mikaela</td>     
                                        <td>
                                            <a href="" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteLogEntry"><i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            
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
                        <form>
                          

                            {!! Form:: submit('DELETE', ['class'=>'btn btn-link waves-effect']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End Delete-->

           

        </div>

	
@stop