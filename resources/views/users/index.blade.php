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
                    <table class="table table-hover dashboard-task-infos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>User</th>
                            	<th>Status</th>
                           	</tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="#">Created new journal</a></td>
                                <td>Viktor Nikiforov</td>
                                <td><span class="label bg-orange">Draft</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="#">New Cash Disbursement</a></td>
                                <td>Otabek Altin</td>
                                <td><span class="label bg-green">Done</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="#">Added new document</a></td>
                                <td>Otabek Altin</td>
                                <td><span class="label bg-green">Done</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@stop