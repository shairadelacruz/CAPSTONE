@extends('layouts.admin')

@section('page_title')

Documents

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

                                   <!-- <input type="text" class="datepicker form-control" placeholder="From Date">

                                    <input type="text" class="datepicker form-control" placeholder="To Date"> -->

                                </div>
                            </div>

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Document</th>
                                        <th>Reference No</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Received By</th>
                                        <th>Received From</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>                         
                                    <tr>
                                        <th>Document</th>
                                        <th>Reference No</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Received By</th>
                                        <th>Received From</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($logs)
                                    @foreach($logs as $log)
                                    <tr>
                                    

                                        <td><a href="{{asset('images/' . $log->document_path) }}" data-sub-html="Demo Description">
                                        <img class="img-responsive" src="{{asset('images/' . $log->document_path) }}" alt="" class="img-responsive" width="75">
                                        </a></td>
                                        <td>{{$log->reference_no}}</td>
                                        <td>{{$log->date_received->toDateString()}}</td>
                                        <td>{{$log->document_type->name}}</td>
                                        <td>{{$log->user->name}}</td>
                                        <td>{{$log->received_from}}</td>
                                        <td>
                                            @if(empty($log->journal_details))
                                            Posted
                                            @elseif(empty($log->bill))
                                            Posted
                                            @elseif(empty($log->invoice))
                                            Posted
                                            @else
                                            Pending
                                            @endif
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
        </div>

    
@stop