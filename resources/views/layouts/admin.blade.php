<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('page_title')</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('images/logo.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{asset('plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

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
                <a class="navbar-brand" href="index.html">Accounting Made Easy</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true">Switch Client<i class="material-icons">more_vert</i></a></li>
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
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">ACCOUNTANT</li>
                    <li>
                        <a href="/ames/public/admin">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">format_list_numbered</i>
                            <span>Accounting</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="transactions.html">Transactions</a>
                            </li>
                            <li>
                                <a href="journal-view.html">Journal Entries</a>
                            </li>
                            <li>
                                <a href="coa-view-accounting.html">Chart of Accounts</a>
                            </li>
                            <li>
                                <a href="vat-view-accounting.html">VAT Codes</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">payment</i>
                            <span>Accounts Payable</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="bills.html">Bills</a>
                            </li>
                            <li>
                                <a href="vendors.html">Vendor</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Accounts Receivable</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="invoice-view.html">Invoices</a>
                            </li>
                            <li>
                                <a href="customers.html">Customers</a>
                            </li>
                            <li>
                                <a href="products-and-services.html">Products and Services</a>
                            </li>
 
                        </ul>
                    </li>
                    
                    <li>
                        <a href="{{route('users.cashdisbursement.index')}}">
                            <i class="material-icons">monetization_on</i>
                                <span>Cash Disbursement</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="images.html">
                            <i class="material-icons">image</i>
                                <span>Images</span>
                        </a>
                    </li>


                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assessment</i>
                            <span>Reports</span>
                        </a>
                        
                    </li>

                    <li class="header">ADMIN</li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">account_circle</i>
                            <span>Employees</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('admin.users.index')}}">Users</a>
                            </li>
                            <li>
                                <a href="/">Evaluation</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('admin.clients.index')}}">
                            <i class="material-icons">group</i>
                            <span>Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Management</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('admin.management.assign.index')}}">Client Assignment</a>
                            </li>
                            <li>
                                <a href="{{route('admin.management.task.index')}}">Task Assignment</a>
                            </li>
                            <li>
                                <a href="{{route('admin.management.logs.index')}}">Log</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">list</i>
                            <span>Lists</span>
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
                            <span>{{$client_name->company_name}}</span>
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
    <script src="{{asset('plugins/jquery/jquery.min.js') }} "></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js') }} "></script>

    <!-- Select Plugin Js -->
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js') }} "></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }} "></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('plugins/node-waves/waves.js') }} "></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('plugins/jquery-countto/jquery.countTo.js') }} "></script>

    <!-- Custom Js -->
    <script src="{{asset('js/admin.js') }} "></script>

    <!-- Demo Js -->
    <script src="{{asset('js/demo.js') }} "></script>

    @yield('scripts')

    @yield('footer')

</body>

</html>