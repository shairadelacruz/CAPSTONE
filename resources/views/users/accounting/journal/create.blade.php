@extends('layouts.admin')

@section('page_title')

Journal

@endsection

@extends('includes.table_includes');

@section('content')

    <div id="journal">

        <div class = "panel panel-default" v-clock>
            
            <div class = "panel-heading">

                <div class = "clearfix">
                    
                    <span class = "panel-title">Create Journal</span>
                    <a href="{{ route('journal', $client_id) }}" class="btn btn-default pull-right">Back</a>

                </div>    

            </div>

            <div class="panel-body">
                
                
                    @include('users.accounting.journal.form')
              
            </div>

            <div class="panel-footer">


                
                <a href="{{ route('journal', $client_id) }}" class="btn btn-default">Cancel</a>
                <button class="btn btn-success" @click="create" :disabled="isProcessing">Create</button>

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
                transaction_no: '',
                date: '',
                description: '',
                details:[{
                    reference_no: '',
                    description: '',
                    debit: 0,
                    credit: 0,
                    vat_id: '',
                    vat_amount: 0,
                    client_coa_id: ''
                }]
            };

    </script>


    <script src="{{asset('js/app.js') }}"></script>
@endsection
	
@stop