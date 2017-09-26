<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('page_title')</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('images/logo.png') }}" type="image/x-icon">
    <!-- Favicon-->
    <link rel="stylesheet" href="{{asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{asset('plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Bootstrap Select Css
    <link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" /> -->

          <link rel="stylesheet" href="{{asset('chosen.min.css') }}"/>

    @yield('links')

    <!-- Custom Css -->
    <link href="{{asset('css/style.css') }} " rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('css/themes/all-themes.css') }} " rel="stylesheet" />
</head>
<body class="theme-green">
    <!-- Page Loader -->
  <!--  <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>-->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">
                AMY - Bookkeeping and Project Monitoring System

                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="fa fa-bell-o fa-fw fa-lg" aria-hidden="true"></i>&nbsp;
                            <span class="label-count">{{Auth::user()->tasks()->where('status', 0)->count()}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Tasks</li>
                            <li class="body">
                                <ul class="menu">
                                @if($tasks = Auth::user()->tasks()->where('status', 0)->get())
                                    @foreach($tasks as $task)
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="menu-info">
                                                <h4>{{$task->name}}</h4>
                                                <p>
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{$task->deadline->diffForHumans()}}
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="/user/tasks">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->


                    @if(Auth::user()->isAdmin()||Auth::user()->isManager()||Auth::user()->isUser()) 
                    <li class="pull-right">
                    <a href="javascript:void(0);" class="js-right-sidebar" data-close="true">@if($client_name = Auth::user()->clients->find(request()->route('client_id')))
                    {{$client_name->company_name}}
                    @else
                    Switch
                    @endif
                    &nbsp;
                    <i class="fa fa-users fa-fw fa-lg" aria-hidden="true"></i>
                    </a>

                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                    <div class="email">{{ Auth::user()->email }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="fa fa-angle-down fa-lg" aria-hidden="true"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="fa fa-user fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Profile</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">

                    @can('menu_user')
                    <li class="header">ACCOUNTANT</li>
                    <li>
                        <a href="/admin">
                            <i class="fa fa-home fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Home</strong></a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-calculator fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Accounting</strong>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/user/{{request()->route('client_id')}}/accounting/transaction">Transactions</a>
                            </li>
                            <li>
                                <a href="/user/{{request()->route('client_id')}}/accounting/journal">Journal Entries</a>
                            </li>
                            <li>
                                <a href="/user/{{request()->route('client_id')}}/accounting/coa">Chart of Accounts</a>
                            </li>
                            <li>
                                <a href="/user/{{request()->route('client_id')}}/accounting/vat">VAT Codes</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-credit-card-alt fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Accounts Payable</strong>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/user/{{request()->route('client_id')}}/payable/bill">Bills</a>
                            </li>
                            <li>
                                <a href="/user/{{request()->route('client_id')}}/payable/vendor">Vendor</a>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-credit-card fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Accounts Receivable</strong>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/user/{{request()->route('client_id')}}/receivable/invoice">Invoices</a>
                            </li>
                            <li>
                                <a href="/user/{{request()->route('client_id')}}/receivable/customer">Customers</a>
                            </li>
                            <li>
                                <a href="/user/{{request()->route('client_id')}}/receivable/item">Products and Services</a>
                            </li>
 
                        </ul>
                    </li>
                    <li>
                        <a href="/user/{{request()->route('client_id')}}/documents">
                            <i class="fa fa-angle-double-right fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Adjusting Entries</strong>
                        </a>
                    </li>
                    <li>
                        <a href="/user/{{request()->route('client_id')}}/documents">
                            <i class="fa fa-file-text fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Documents</strong>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-bar-chart fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Reports</strong>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/user/{{request()->route('client_id')}}/reports/audit">Audit Trail</a>
                            </li>
                        </ul>
                        
                    </li>

                    @endcan

                    @if(Auth::user()->isAdmin()) 
                        <li class="header">ADMIN</li>
                    @endIf

                    @if(Auth::user()->isManager()) 
                        <li class="header">Manager</li>
                    @endIf
                    
                    @can('menu_admin')

                        
                    <li>
                        <a href="{{route('admin.clients.index')}}">
                            <i class="fa fa-users fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Clients</strong>
                        </a>
                    </li>
                    @endcan
                    @can('menu_manager')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-calendar fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Management</strong>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('admin.management.assign.index')}}">Clients</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">Team</a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="/admin/management/myteam">My Teams</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.management.team.index')}}">Assignment</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">Tasks</a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="/user/tasks">My Tasks</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.management.task.index')}}">Assignment</a>
                                    </li>
                                </ul>
                            </li>
                        
                         
                        </ul>
                    </li>
                    @endcan
                    @can('menu_admin')
                    @can('menu_receptionist')
                    <li>
                        <a href="{{route('admin.management.logs.index')}}">
                            <i class="fa fa-book fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Document Logs</strong>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-list fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Lists</strong>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('admin.lists.coa.index')}}">Chart of Accounts</a>
                            </li>
                            <li>
                                <a href="{{route('admin.lists.vat.index')}}">VAT Codes</a>
                            </li>
                            <li>
                                <a href="{{route('admin.lists.business.index')}}">Industry Types</a>
                            </li>
                            <li>
                                <a href="{{route('admin.lists.document.index')}}">Document Types</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="fa fa-wrench fa-fw fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Utilities</strong>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('admin.utilities.users.index')}}">Users</a>
                            </li>
                            <li>
                                <a href="{{route('admin.utilities.closing.index')}}">Closing Transactions</a>
                            </li>
                            <li>
                                <a href="{{route('admin.utilities.activity.index')}}">Activity Log</a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">CLIENTS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                 
                    <ul class="demo-choose-skin">
                    @if($client_names = Auth::user()->clients->all())
                    @foreach($client_names as $client_name)
                        <li>
                        <a href="/user/{{$client_name->id}}/home">
                            <span>{{$client_name->company_name}}</span>
                            </a>
                        </li>   
                         @endforeach
                                @endif 
                    </ul>
                   
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
    

    <section class="content">

    @yield('content')

    </section>


    <!-- Jquery Core Js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js') }} "></script>


    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }} "></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('plugins/node-waves/waves.js') }} "></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('plugins/jquery-countto/jquery.countTo.js') }} "></script>

    <!-- Custom Js -->
    <script src="{{asset('js/admin.js') }} "></script>

    <!-- Demo Js -->

    <script src="{{asset('chosen.jquery.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
      $(".chosen-select").chosen({
        width:"100%"
      })

</script>
    

    @yield('scripts')

    @yield('footer')

</body>

</html>