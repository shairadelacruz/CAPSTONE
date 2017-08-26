@section('links')

    <!-- Wait Me Css -->
    <link href="{{asset('plugins/waitme/waitMe.css') }}" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
    <!-- Multi Select Css -->
    <link href="{{asset('plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

@endsection

@section('scripts')

    <script src="{{asset('js/pages/forms/basic-form-elements.js') }}"></script>
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{asset('plugins/momentjs/moment.js') }}"></script>
      <!-- Multi Select Plugin Js -->
    <script src="{{asset('plugins/multi-select/js/jquery.multi-select.js') }}"></script>

@endsection