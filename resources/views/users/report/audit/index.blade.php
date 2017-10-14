@extends('layouts.admin')

@section('page_title')

Audit Trail

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
                                Audit Trail
                            </h2><br>

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Transaction No.</th>
                                        <th>Date</th>
                                        <th>Modified By</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                
                                    <tr>
                                        <th>Transaction No.</th>
                                        <th>Date</th>
                                        <th>Modified By</th>
                                        <th>Total</th>

                                    </tr>
                                    
                                </tfoot>
                                <tbody>
                                @if($activities)
                                
                                    @foreach($activities as $activity)
                                    @if($activity->subject_type == 'App\Journal')
                                    @if($activity->subject->client == $client)
                                    <tr>
                                        <td>{{$activity->subject->transaction_no}}</td>
                                        <td>{{$activity->created_at->toDateString()}}</td>
                                        <td>{{$activity->user->name}}</td>
                                        <td>{{$activity->subject->debit_total}}</td>

                                    </tr>
                                     @endif
                                     @endif
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