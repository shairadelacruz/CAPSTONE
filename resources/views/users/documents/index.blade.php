@extends('layouts.admin')

@section('page_title')

Log

@endsection

@extends('includes.table_includes');
@extends('includes.gallery_includes');

@section('content')

        <div class="container-fluid">
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Documents
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <button type="button" class="btn btn-primary waves-effect">+Add</button>
                                </div>
                            </div>
                            

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" da>
                                <thead>
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Document Type</th>
                                        <th>Received From</th>
                                        <th>Received By</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Document Type</th>
                                        <th>Received From</th>
                                        <th>Received By</th>
                                        <th>Image</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>0024601</td>
                                        <td>Others</td>
                                        <td>Bakugou Katsuki</td>
                                        <td>Uraraka Ochako</td>
                                        <td><img class="img-responsive" src="" alt="" class="img-responsive" width="75"></td>
                                    </tr>
                                    <tr>
                                        <td>0530712</td>
                                        <td>Receipt</td>
                                        <td>John Smith</td>
                                        <td>Ronald McDonald</td>
                                        <td><img class="img-responsive" src="" alt="" class="img-responsive" width="75"></td>
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