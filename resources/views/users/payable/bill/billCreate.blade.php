{!!Form::open(['route' => ['insertbill', $client_id], 'id'=>'frmsave', 'method'=>'POST'])!!}
                                           
                <div class="row">

                    <div class="col-sm-12">

                        <input type="hidden" class="clientHidden" name='client_id' value="{{ $client_id }}">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Transaction No.</label>
                                @if($client_name = Auth::user()->clients->find(request()->route('client_id')))
                                <input type="text" class="form-control" name='transaction_no' value="{{Carbon\Carbon::today()->format('Y')}}-{{$client_name->code}}{{$client_name->id}}-{{$count}}-B" readonly="true">
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Reference No.</label>
                                <select class="chosen-select form-control" name="reference_no">
                                <option value="0" selected="true">Please select an option</option>
                                @if($refs)
                                @foreach($refs as $ref)
                                    <option value="{{$ref->id}}">{{$ref->reference_no}}</option>
                                @endforeach
                                @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Vendor</label>
                                <select class="table-control chosen-select" name="vendor_id">
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
                            <div class="form-group">
                                <label>Bill Date</label>
                                <input type="date" class="form-control" name='bill_date' value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" min="{{ \Carbon\Carbon::parse($client->closing->where('status', 0)->last()->created_at)->format('Y-m') }}-01">
                            </div>
                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" class="form-control" name='due_date' value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" min="{{ \Carbon\Carbon::parse($client->closing->where('status', 0)->last()->created_at)->format('Y-m') }}-01">
                            
                            </div>
                        </div>
                
                    </div>

                </div>

                    
                    <div class="body table-responsive">
                        <table id="billtable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Account</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>VAT Code</th>
                                    <th>VAT Amount</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="billTbody">
                                <tr>
                                    <td class="table-item_id">
                                    <select class="table-control chosen-select productname getrate" name="item_id[]">
                                          <option value="0" selected="true" disabled="true"></option>          
                                                @if($items)
                                                @foreach($items as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-coa_id">
                                    <select class="table-control chosen-select coaname" name="coa_id[]">
                                                 <option value="0" selected="true" disabled="true"></option>   
                                                @if($coas)
                                                @foreach($coas as $coa)
                                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-descriptions">
                                        <input type="text" class="description" name="descriptions[]">
                                    </td>
                                    <td class="table-qty">
                                        <input type="number" class="qty right-align-text getrate" value="0" name="qty[]" >
                                    </td>
                                    <td class="table-price">
                                        <input type="number" class="price right-align-text getrate" value="0" name="price[]" step="0.01">
                                    </td>

                                    <td class="table-vat_id">
                                        <select class="vat_id table-control chosen-select getrate" name="vat_id[]">
                                                <option value="0" selected="true" disabled="true">Choose</option>
                                                @if($vats)
                                                @foreach($vats as $vat)
                                                    <option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate">{{ number_format($vat->rate, 0) }}</span>%</option>
                                                @endforeach
                                                @endif
                                        </select>
                                    </td>
                                    <td class="table-vat_amount" >
                                        <input type="number" name="vat_amount[]" value="0" class="right-align-text vat_amount" step="0.01">
                                    </td>
                                    <td class="table-total">
                                        <input type="number" value="0" class="subTotal right-align-text" name="total[]" step="0.01">
                                    </td>

                                    <td class="table-remove">
                                        <span onclick="removeRow(this)" class="table-remove-btn btn btn-default">X</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <span onclick="addRow()" class="table-add_line btn btn-default">Add Line</span>
                                    </td>
                                    <td>Total</td>
                                    <td class="table-grandTotal">
                                        <input type="number" value="" class="table-control right-align-text grandTotal" name="grandTotal" step="0.01">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>