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
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="/user/{{request()->route('client_id')}}/reports/audit">Go to Audit Trail</a></li>
                            </ul>
                        </li>
                    </ul>
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
                          @if($activities)
                                
                                    @foreach($activities as $activity)
                                    @if($activity->subject_type != 'App\Task')
                                    @if($activity->subject->client == $client)
                                    <tr>
                                        <td>{{$activity->created_at->toDateString()}}</td>
                                        <td>{{$activity->created_at->toTimeString()}}</td>
                                        <td>{{$activity->user->name}}</td>
                                        <td>@include ("admin.utilities.activity.types.{$activity->name}")</td>

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

    <div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>OVERDUE BILLS AND INVOICES</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="/user/{{request()->route('client_id')}}/payable/bill">Go to Bills</a></li>
                                <li><a href="/user/{{request()->route('client_id')}}/receivable/invoice">Go to Invoice</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <ul class="dashboard-stat-list">
                        <li>
                            Bill #05678
                            <span class="pull-right"><b>3 </b><small>DAYS</small></span>
                        </li>
                        <li>
                            Invoice #32521
                            <span class="pull-right"><b>1 </b><small>DAY</small></span>
                        </li>
                        <li>
                            Bill #24601
                            <span class="pull-right"><b>10 </b><small>DAYS</small></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Bar Chart -->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>INCOME AND EXPENSE</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="/user/{{request()->route('client_id')}}/payable/bill">Go to Bills</a></li>
                                <li><a href="/user/{{request()->route('client_id')}}/receivable/invoice">Go to Invoice</a></li>
                                <li><a href="/user/{{request()->route('client_id')}}/reports/profitandloss">Go to Profit and Loss</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <canvas id="ie_chart" height="150"></canvas> <!--ie as in income and expense lol-->
                </div>
            </div>
        </div>
        <!-- #END# Bar Chart -->
        <!-- Donut Chart -->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>EXPENSES</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="/user/{{request()->route('client_id')}}/payable/bill">Go to Bills</a></li>
                                <li><a href="/user/{{request()->route('client_id')}}/payable/vendor">Go to Vendors</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <canvas id="expense_chart" height="150"></canvas>
                </div>
            </div>
        </div>
        <!-- #END# Donut Chart -->


    </div>
</div>

    <!-- Chart Plugin Js -->
    <script src="{{asset('plugins/chartjs/Chart.bundle.js') }}"></script>
    <script src="{{asset('plugins/chartjs/Chart.js') }}"></script>

<script >



    var invoices = [42,7000,2500,8000,9000,3000,5000,4000,6500,8700,3400,10000];


    var ieCanvas = document.getElementById('ie_chart');
    var barChart = new Chart(ieCanvas, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
            datasets: [
            {
                label: "Income",
                backgroundColor: 'rgba(0, 188, 212, 0.8)',
                data: invoices
            },{
                label: "Expense",
                backgroundColor: 'rgba(233, 30, 99, 0.8)',
                data: [2000,5000,500,6000,7000,1000,3000,2000,4500,6700,1400,80000]
            }]
        }
    });
</script>

<script>
    var expCanvas = document.getElementById("expense_chart");
    var donutChart = new Chart(expCanvas, {
        type: 'doughnut',
        data: {
          labels: ["Expense 1", "Expense 2", "Expense 3", "Expense 4", "Expense 5"],
          datasets: [
            {
              label: "Expenses",
              backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
              data: [2478,5267,734,784,433]
            }
          ]
        }
    });

    $(function(){
        new Chart(document.getElementById("expense_chart").getContext("2d"), {
            type: 'doughnut',
            data: {
              labels: ["Expense 1", "Expense 2", "Expense 3", "Expense 4", "Expense 5"],
              datasets: [
                {
                  label: "Expenses",
                  backgroundColor: ["rgb(233, 30, 99)", "rgb(255, 193, 7)", "rgb(0, 188, 212)", "rgb(139, 195, 74)"],
                  data: [2478,5267,734,784,433]
                }
              ]
            }
        })
    })
</script>

    
@stop