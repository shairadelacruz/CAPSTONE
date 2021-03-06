{!!Form::open(['route' => ['insertcb', $client_id], 'id'=>'frmsave2', 'method'=>'POST'])!!}
<div class="body table-responsive">
                        <table class="table table-bordered table-form">
                            <thead>
                                

                                <tr>
                                    <th>Reference No.</th>
                                    <th>Date</th>
                                    <th>Vendor</th>
                                    <th>Account</th>
                                    <th>Amount</th>
                                    <th>VAT Code</th>
                                    <th>VAT Amount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="cbTbody">
                                <tr>
                                    <td>
                                <select class="table-control chosen-select" name="reference_no[]">
                                <option value="0" selected="true">Choose</option>
                                @if($refs)
                                @foreach($refs as $ref)
                                    <option value="{{$ref->id}}">{{$ref->reference_no}}</option>
                                @endforeach
                                @endif
                                </select>
                                   </td> 
                                    <td class="table-bill_date">
                                        <input type="date" class="table-control" name="bill_date[]" min="{{ \Carbon\Carbon::parse($client->closing->where('status', 0)->last()->created_at)->format('Y-m') }}-01">
                                    </td>
                                    <td class="table-vendor">
                                        <select class="table-control chosen-select" name="vendor_id[]">
                                    <option value="0" selected="true" disabled="true"></option>
                                        @if($vendors)
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                        @endforeach
                                        @endif
                                </select>
                                    </td>
                                    <td class="table-coa_id">
                                    <select class="table-control chosen-select" name="coa_id[]" required="true">
                                            <option value="0" selected="true" disabled="true">Choose</option>
                                                @if($coas)
                                                @foreach($coas as $coa)
                                            <option value="{{$coa->id}}">{{$coa->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-amount">
                                        <input type="number" class="table-control getrate_cd price_cd" name="amount[]" step="0.01">
                                    </td>

                                    <td>
                                        <select class="table-control chosen-select getrate_cd vat_id_cd" name="vat_id[]">
                                                <option value="0" selected="true">Choose</option>
                                                @if($vats)
                                                @foreach($vats as $vat)
                                                    <option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate">{{ number_format($vat->rate, 0) }}</span>%</option>
                                                @endforeach
                                                @endif
                                    </select>
                                    </td>
                                    <td class="table-vat_amount">
                                        <input type="number" class="table-control vat_amount_cd right-align-text" name="vat_amount[]" value="0"  step="0.01">
                                    </td>
                                    <td>
                                        <input type="number" class="table-control total_cd right-align-text" name="total_cd[]" step="0.01" value="0">
                                    </td>
                                    <td class="table-remove">
                                        <input type="hidden" name='client_id[]' value="{{ $client_id }}" class="form-control">
                                        <span onclick="removeRow(this)" class="table-remove-btn btn btn-default">X</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <span onclick="addRowCb()" class="table-add_line btn btn-default">Add Line</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>