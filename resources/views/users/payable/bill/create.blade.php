@extends('layouts.admin')

@section('page_title')

Bill

@endsection

@extends('includes.form_includes');

@section('content')
    <div id="bill">

        <div class = "panel panel-default" v-clock>
            
            <div class = "panel-heading">

                <div class = "clearfix">
                    
                    <!-- Nav tabs -->
                     <ul class="nav nav-tabs tab-nav-right" role="tablist">
                        <li role="presentation" class="active"><a href="#billTab" data-toggle="tab">Bill</a></li>
                        <li role="presentation"><a href="#cbTab" data-toggle="tab">Cash Disbursement</a></li>
                        <a href="{{ route('bill', $client_id) }}" class="btn btn-default pull-right">Back</a>
                    </ul>           
                </div>    
            </div>
            <div class="panel-body">         
                <div class="body">
                            <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="billTab">
                            @include ("users.payable.bill.billCreate")

                            <a href="{{ route('bill', $client_id) }}" class="btn btn-default">Cancel</a>
                
                            <input type='submit' value='Create' class="btn btn-success">
                
                            {!!Form::close()!!}
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="cbTab">
                            @include ("users.payable.bill.cbCreate")

                            <a href="{{ route('bill', $client_id) }}" class="btn btn-default">Cancel</a>
                
                            <input type='submit' value='Create' class="btn btn-success">
                
                            {!!Form::close()!!}
                                
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">

                @include('includes.form_error')

            </div>

        </div>
        
    </div>

                        


@section('scripts')
    <script src="{{asset('js/vue.min.js') }}"></script>
    <script src="{{asset('js/vue-resource.min.js') }}"></script>
    <script type="text/javascript">
        
        Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';
        
        window.client = {!! json_encode($client_id) !!} 
            window._form = {

                client_id: {{$client_id}},
                vendor_id: '',
                bill_date: '',
                due_date: '',
                details:[{
                    item_id: '',
                    coa_id: '',
                    descriptions: '',
                    price: 0,
                    qty: 1,
                    vat_id: '',
                    vat_amount: 0,
                    total: 0
                }]
            };

    </script>
    
    <script src="{{asset('js/billinvoice/app.js') }}"></script>
 
@endsection
@stop