@extends('layouts.admin')

@section('page_title')

Bill

@endsection

@extends('includes.form_includes');

@section('content')
<div id="bill">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="clearfix">
                <span class="panel-title">Create Bill</span>
                <a href="#" class="btn btn-default pull-right">Back</a>
            </div>
        </div>
        <div class="panel-body">
                <div class="row">

                    {!!Form::open(array('route'=>null, 'id'=>'frmsave', 'method'=>'POST', 'action'=>['UserBillsController@store', $client_id]))!!}

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Bill No.</label>
                                    <input type="text" name="bill_no" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Vendor</label>
                                        <select name="vendor_id">
                                                <option value="0" selected="true" disabled="true"></option>
                                            @if($vendors)
                                            @foreach($vendors as $vendor)
                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                            @endforeach
                                            @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">

                                <label>Bill Date</label>
                                <input type="date" name="bill_date" class="form-control">

                                <label>Due Date</label>
                                <input type="date" name="due_date" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body table-responsive">
                <table class="table table-bordered table-form">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Acount</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>VAT Code</th>
                            <th>VAT Amount
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="detail in form.details">
                            <td class="table-item">
                                <select v-model="detail.item_id" name="item_id[]">
                                    <option value="0" selected="true" disabled="true"></option>
                                @if($items)
                                @foreach($items as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                @endif
                                </select>
                            </td>
                            <td class="table-coa">
                                <select name="coa_id[]">
                                    <option value="0" selected="true" disabled="true"></option>
                                @if($coas)
                                @foreach($coas as $coa)
                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                @endforeach
                                @endif
                                </select>
                            </td>
                            <td class="table-description">
                                <input type="text" name="description[]" class="table-control">
                            </td>
                            <td class="table-price">
                                <input type="number" name="price[]" class="table-control">
                            </td>
                            <td class="table-qty">
                                <input type="number" name="qty[]" class="table-control">
                            </td>
                            <td class="table-vatcode">
                                <select name="vat_id[]">
                                    <option value="0" selected="true" disabled="true"></option>
                                @if($vats)
                                @foreach($vats as $vat)
                                    <option value="{{$vat->id}}">{{$vat->vat_code}}</option>
                                @endforeach
                                @endif
                                </select>
                            </td>
                            <td class="table-vatamount">
                                <input type="number" name="vat_amount[]" class="table-control">
                            </td>
                            <td class="table-total">
                                <span class="table-text"></span>
                            </td>
                            <td class="table-remove">
                                <span @click="remove(detail)" class="table-remove-btn remove">&times;</span>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="table-empty" colspan="2">
                                <span @click="addLine" class="table-add_line add">Add Line</span>
                            </td>
                            <td class="table-label">Total</td>
                            <td class="table-amount">@{{subTotal}}</td>
                        </tr>
                    </tfoot>
                </table>
                </div>

                
                </div>
            <div class="panel-footer">
                <a href="#" class="btn btn-default">CANCEL</a>
                <button class="btn btn-success">CREATE</button>
            </div>
            {!!Form::close()!!}
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
                    description: '',
                    price: 0,
                    qty: 0,
                    vat_id: '',
                    vat_amount: 0,
                    
                }]
            };

    </script>
    <script src="{{asset('js/billvue.js') }}"></script>

    <script type="text/javascript">
        
        $('.remove').on('live', function(){
            $(this).parent().parent().remove();
        });
    </script>
@endsection
@stop