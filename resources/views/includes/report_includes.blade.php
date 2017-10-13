
<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>@yield('page_title')</title>
  <!-- Bootstrap Core Css -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
    <style>
        
        h1 {
        
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            font-family: "Arial";
        }
        
        h2 {
            
            text-align: center;
            font-size: 25px;
            font-weight: 200;
            font-family: "Verdana";
           
        }
        
        h3 {
            
            text-align: center;
            font-size: 17px;
            font-weight: normal;
            font-family: "Georgia";
            
        }
        
        
        </style>
    </head>
<body>
    

    
    <div class="container">
    
        <section class="content">

    @yield('content')

        </section>

        
        
    </div>

    <!-- Jquery Core Js -->
    <script src="{{asset('plugins/jquery/jquery.min.js') }} "></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js') }} "></script>

</body>    
</html>