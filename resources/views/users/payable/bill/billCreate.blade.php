{!!Form::open(['route' => ['insertbill', $client_id], 'id'=>'frmsave', 'method'=>'POST'])!!}
                                           
                <div class="row">

                    <div class="col-sm-12">

                        <input type="hidden" class="clientHidden" name='client_id' value="{{ $client_id }}" class="form-control">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Reference No.</label>
                                <input type="text" class="form-control" name='reference_no'>
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
                        <div class="col-sm-6">
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
                        <table class="table table-bordered">
                            <thead>
                                <col width="14%">
                                <col width="20%">
                                <col width="20%">
                                <col width="8%">
                                <col width="14%">
                                <col width="14%">
                                <col width="14%">
                                <col width="14%">
                                <col width="4%">
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
                                    <select class="table-control chosen-select productname" name="item_id[]">
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
                                        <input type="number" class="qty" name="qty[]">
                                    </td>
                                    <td class="table-price">
                                        <input type="number" class="price" name="price[]" step="0.01">
                                    </td>

                                    <td class="table-vat_id">
                                        <select class="vat_id table-control chosen-select" name="vat_id[]">
                                                    <option value="0" selected="true" disabled="true">Choose</option>
                                                @if($vats)
                                                @foreach($vats as $vat)
                                                    <option value="{{$vat->id}}">{{$vat->vat_code}} - {{ number_format($vat->rate, 0) }}%
                                                    </option>
                                                @endforeach
                                                @endif
                                    </select>
                                    </td>
                                    <td class="table-vat_amount" >
                                        <input type="number" name="vat_amount[]" step="0.01">
                                    </td>
                                    <td class="table-total">
                                        <input type="number" value="0" class="subTotal right-align-text" name="total[]" step="0.01">
                                    </td>

                                    <td class="table-remove">
                                        <span onclick="removeRow(this)" class="table-remove-btn">X</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <span onclick="addRow()" class="table-add_line">+ Add Line</span>
                                    </td>
                                    <td>Total</td>
                                    <td class="table-grandTotal">
                                        <input type="number" value="" class="table-control right-align-text" name="grandTotal" readonly="true" step="0.01">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>