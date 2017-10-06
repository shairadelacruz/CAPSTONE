@extends('layouts.admin')

@section('page_title')

{{$client->company_name}}

@endsection

@section('company_name')

{{$client->company_name}}

@endsection

@section('content')
    
<div class="container-fluid">
    <div class="block-header">
    	<h1>{{$client->company_name}}</h1>
    </div>
            <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                       RECENT
                    </h2><br>
                </div>
                
                <div class="body table-responsive">
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
                            
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@stop