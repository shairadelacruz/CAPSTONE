{!!Form::open(['route' => ['insertbill', $client_id], 'id'=>'frmsave', 'method'=>'POST'])!!}
                                           
                <div class="row">

                    <div class="col-sm-12">

                        <input type="hidden" name='client_id' value="{{ $client_id }}" class="form-control">

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
                                <input type="date" class="form-control" name='bill_date' value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                            </div>
                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" class="form-control" name='due_date' value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                            
                            </div>
                        </div>
                
                    </div>

                </div>

                    
                    <div class="body">
                        <table style="table-layout:fixed;" class="table table-bordered">
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
                            <tbody>
                                <tr>
                                    <td class="table-item_id">
                                    <select class="table-control chosen-select" name="item_id[]">
                                                    
                                                @if($items)
                                                @foreach($items as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-coa_id">
                                    <select class="table-control chosen-select" name="coa_id[]">
                                                    
                                                @if($coas)
                                                @foreach($coas as $coa)
                                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-descriptions">
                                        <input type="text" name="descriptions[]">
                                    </td>
                                    <td class="table-qty">
                                        <input type="number" class="form-control" name="qty[]">
                                    </td>
                                    <td class="table-price">
                                        <input type="number" class="table-control" name="price[]" step="0.01">
                                    </td>

                                    <td class="table-vat_id">
                                        <select class="table-control chosen-select" name="vat_id[]">
                                                    <option value="0" selected="true" disabled="true">Choose</option>
                                                @if($vats)
                                                @foreach($vats as $vat)
                                                    <option value="{{$vat->id}}">{{$vat->vat_code}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                    </td>
                                    <td class="table-vat_amount" >
                                        <input type="number" class="table-control" name="vat_amount[]" step="0.01">
                                    </td>
                                    <td class="table-total">
                                        <input type="number" value="" class="table-control" name="total[]" step="0.01">
                                    </td>

                                    <td class="table-remove">
                                        <span class="table-remove-btn">X</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <input type="button" id ="addLine" class="table-add_line" value="+ Add Line">
                                    </td>
                                    <td>Total</td>
                                    <td class="table-grandTotal">
                                        <input type="number" value="" class="table-control right-align-text" name="grandTotal" readonly="true" step="0.01">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>