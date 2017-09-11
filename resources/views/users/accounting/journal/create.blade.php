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
                
                {!!Form::open(['route' => ['insertjournal', $client_id], 'id'=>'frmsave', 'method'=>'POST'])!!}
                
                    
<div class="row">

    <div class="col-sm-12">
                @if(Session::has('ref_no'))
                <p class="bg-danger">{{Session('ref_no')}}</p>
                @endif

        <input type="hidden" name='client_id' value="{{ $client_id }}" class="form-control">

        <div class="col-sm-4">
            <div class="form-group">
                <label>Transaction No.</label>
                <input type="text" class="form-control" v-model="form.transaction_no" name='transaction_no'>
                <p v-if="errors.transaction_no" class="error">@{{ errors.transaction_no}}</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" v-model="form.date" name='date'>
                <p v-if="errors.date" class="error">@{{ errors.date}}</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" v-model="form.description" name='description'></textarea>
                <p v-if="errors.description" class="error">@{{ errors.description}}</p>
            </div>
        </div>

    </div>

</div>


    <hr>

    <div v-if="errors.details_empty">
        <p class="alert alert-danger">@{{ errors.details_empty }}</p>
        </hr>
    </div>
    
    <div class="body table-responsive">
        <table class="table table-bordered table-form">
            <thead>
                <tr>
                    <th>Reference No.</th>
                    <th>Account</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Description</th>
                    <th>VAT Code</th>
                    <th>VAT Amount</th>
                    <!--<th>Person</th>-->
                </tr>
            </thead>
            <tbody>
                <tr v-for="detail in form.details">
                    <td class="table-reference_no" :class="{'table-error': errors['details' + $index + '.reference_no']}">
                        <input id="reference_no" type="text" name="reference_no[]" class="table-control" v-model="detail.reference_no" value="{{Session('ref_no')}}">
                    </td>
                    <td class="table-client_coa_id" :class="{'table-error': errors['details' + $index + '.client_coa_id']}">
                    <select class="table-control" name="coa_cli_id[]" v-model="detail.client_coa_id">
                                    <option value="0" selected="true" disabled="true"></option>
                                @if($coas)
                                @foreach($coas as $coa)
                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                @endforeach
                                @endif
                    </select>
                        
                    </td>
                    <td class="table-debit" :class="{'table-error': errors['details' + $index + '.debit']}">
                        <input type="number" class="table-control right-align-text" v-model="detail.debit" name="debit[]">
                    </td>
                    <td class="table-credit" :class="{'table-error': errors['details' + $index + '.credit']}">
                        <input type="number" class="table-control right-align-text" v-model="detail.credit" name="credit[]">
                    </td>
                    <td class="table-description" :class="{'table-error': errors['details' + $index + '.description']}">
                        <input type="text" class="table-control" v-model="detail.description" name="descriptions[]">
                    </td>
                    <td class="table-vat_id" :class="{'table-error': errors['details' + $index + '.vat_id']}">
                        <select class="table-control" name="vat_id[]" v-model="detail.vat_id">
                                    <option value="0" selected="true" disabled="true"></option>
                                @if($vats)
                                @foreach($vats as $vat)
                                    <option value="{{$vat->id}}">{{$vat->vat_code}}</option>
                                @endforeach
                                @endif
                    </select>
                    </td>
                    <td class="table-vat_amount" :class="{'table-error': errors['details' + $index + '.vat_amount']}">
                        <input type="number" class="table-control right-align-text" v-model="detail.vat_amount" name="vat_amount[]">
                    </td>
                    <!--<td class="table-vendor_id" :class="{'table-error': errors['details' + $index + '.vendor_id']}">
                        <input type="text" class="table-control" v-model="detail.vendor_id" name="vendor_id[]">
                    </td>-->
                    <td class="table-remove">
                        <span @click="remove(detail)" class="table-remove-btn">X</span>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="table-empty">
                        <span @click="addLine" class="table-add_line">+ Add Line</span>
                    </td>
                    <td>Total</td>
                    <td class="table-debittot"><input type="number" class="table-control right-align-text" v-model="detail.debittot" name="debittot[]" value="@{{ debitTot }}" readonly="true"></td>
                    <td class="table-credittot"><input type="number" class="table-control right-align-text" v-model="detail.credittot" name="credittot[]" value="@{{ creditTot }}" readonly="true"></td>
                </tr>
            </tfoot>
        </table>
    </div>

            </div>

            <div class="panel-footer">


                
                <a href="{{ route('journal', $client_id) }}" class="btn btn-default">Cancel</a>
                
                <input type='submit' value='Create' class="btn btn-success">
                
                {!!Form::close()!!}
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