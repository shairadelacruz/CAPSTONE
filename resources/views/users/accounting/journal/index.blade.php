@extends('layouts.admin')

@section('page_title')

Journal

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
                                Journal
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href="journal/create" class="btn btn-primary waves-effect">+Add</a>

                                </div>
                            </div>
                            @if(Session::has('deleted_journal'))
                                 <p class="bg-danger">{{Session('deleted_journal')}}</p>
                            @endif

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction No.</th>
                                        <!--<th>Affected</th>-->
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction No.</th>
                                        <!--<th>Affected</th>-->
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($journals)
                                    @foreach($journals as $journal)
                                    <tr>
                                        <td>{{$journal->date->toDateString()}}</td>
                                        <td>{{$journal->transaction_no}}</td>
                                        <!--<td><button class="btn btn-default btn-xs waves-effect">View</button></td>-->
                                        <td class="right-align-text">{{$journal->debit_total}}</td>
                                        <td class="right-align-text">{{$journal->credit_total}}</td>
                                        <td>{{$journal->description}}</td>
                                        <td>
                                            <a href ="journal/{{$journal->id}}/edit" class="btn btn-default btn-xs waves-effect"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteJournal{{$journal->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            <a href ="journal/{{$journal->id}}/show" class="btn btn-default btn-xs waves-effect"><i class="fa fa-print" aria-hidden="true"></i></a>
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

            @if($journals)
                @foreach($journals as $journal)
            
            <!-- Delete journals -->

            <div class="modal fade" id="deleteJournal{{$journal->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Void a Journal</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to void?
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['method'=>'DELETE', 'action'=>['UserJournalsController@destroy', $journal->id, $journal->client_id]]) !!}

                            {!! Form:: submit('VOID', ['class'=>'btn btn-link waves-effect']) !!}

                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
           <!--End Delete Journals--> 
            @endforeach
            @endif

        </div>

	
@stop