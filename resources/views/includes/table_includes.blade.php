@section('links')

<!-- JQuery DataTable Css -->
 <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

 <style type="text/css">
     input{
        width: 100% !important;
     }
 </style>


@endsection

@section('scripts')

    <!-- Jquery DataTable Plugin Js -->
            <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <!--<script src="{{asset('plugins/datatables/filtering/row-based/range_dates.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var table = $('#tableLog').DataTable();
          
        /* Add event listeners to the two range filtering inputs */
        $('#min, #max').keyup( function() {
            table.draw();
        } );
    } );
</script>
    <script type="text/javascript">
    function wow(){
        alert('hi');
    }
</script>-->
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{asset('/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

	<!--custom-->
    <script src="{{asset('js/pages/tables/jquery-datatable.js') }}"></script>

@endsection