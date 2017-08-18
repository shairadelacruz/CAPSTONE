@extends('layouts.admin')

@section('page_title')

Invoice

@endsection

@extends('includes.form_includes');

@section('content')

        <div id="invoice">
        <div class="panel panel-default" v-cloak>
            <div class="panel-heading">
                <div class="clearfix">
                    <span class="panel-title">Create Invoice</span>
                    <a href="#" class="btn btn-default pull-right">Back</a>
                </div>
            </div>
            <div class="panel-body">
                @include('users.receivable.invoice.form')
            </div>
            <div class="panel-footer">
                <a href="#" class="btn btn-default">CANCEL</a>
                <button class="btn btn-success" @click="create" :disabled="isProcessing">CREATE</button>
            </div>
        </div>
        
    </div>

@section('scripts')
    <script src="{{asset('js/vue.min.js') }}"></script>
    <script src="{{asset('js/vue-resource.min.js') }}"></script>
    <script type="text/javascript">
        Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';

        window._form = {
            invoice_no: '',
            client_id: '{{$client_id}}',
            customer_id: '',
            title: '',
            invoice_date: '',
            due_date: '',
            products: [{
                name: '',
                price: 0,
                qty: 1
            }]
        };
    </script>
    <script src="{{asset('js/invoice.js') }}"></script>
@endsection

	
@stop