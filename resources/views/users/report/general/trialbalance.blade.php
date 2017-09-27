@extends('layouts.admin')

@section('page_title')

Trial Balance

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
                                Trial Balance
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    

                                   <input type="date" class="datepicker form-control" placeholder="From Date">

                                    <input type="date" class="datepicker form-control" placeholder="To Date">

                                </div>
                            </div>

                        </div>
                        <div class="body table-responsive">
                            <table id="trialBalanceTable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>                         
                                    <tr id="totals">
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($trials)
                                    @foreach($trials as $trial)
                                    <tr>
                                        <td>{{$trial->name}}</td>
                                        <td>{{$trial->journals_details->sum('debit')}}</td>
                                        <td>{{$trial->journals_details->sum('credit')}}</td>
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


        <script type="text/javascript">
            var body= $('#trialBalanceTable').children('tbody').first();
            var totals = $('#totals');

              var total = 0;
              var columnIndex = $(this).closest('td').index();
              var rows = body.find('tr');
              $.each(rows, function() {
                  var amount = $(this).children('td').eq(columnIndex).children('.sumThis').val();    
                  total += new Number(amount);
              });
              totals.children('td').eq(columnIndex).text(total);
              
        </script>

    
@stop