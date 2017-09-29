{!!Form::open(['route' => ['insertcb', $client_id], 'id'=>'frmsave2', 'method'=>'POST'])!!}
<div class="body">
                        <table style="table-layout:fixed;" class="table table-bordered table-form" width="100">
                            <thead>
                                <col width="14%">
                                <col width="14%">
                                <col width="14%">
                                <col width="14%">
                                <col width="14%">
                                <col width="14%">
                                <col width="14%">

                                <tr>
                                    <th>Reference No.</th>
                                    <th>Date</th>
                                    <th>Vendor</th>
                                    <th>Account</th>
                                    <th>Amount</th>
                                    <th>VAT Code</th>
                                    <th>VAT Amount</th>
                                </tr>
                            </thead>
                            <tbody id="cbTbody">
                                <tr>
                                    <td class="table-reference_no">
                                    <input type="reference_no" class="table-control" name="reference_no[]">   
                                    </td>
                                    
                                    <td class="table-bill_date">
                                        <input type="date" class="table-control" name="bill_date[]">
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
                                    <select class="table-control chosen-select" name="coa_id[]">
                                            <option value="0" selected="true" disabled="true">Choose</option>
                                                @if($coas)
                                                @foreach($coas as $coa)
                                            <option value="{{$coa->id}}">{{$coa->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-amount">
                                        <input type="number" class="table-control" name="amount[]" step="0.01">
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
                                    <td class="table-vat_amount">
                                        <input type="number" class="table-control" name="vat_amount[]" step="0.01">
                                    </td>
                                    <td class="table-remove">
                                        <input type="hidden" name='client_id[]' value="{{ $client_id }}" class="form-control">
                                        <span onclick="removeRow(this)" class="table-remove-btn">X</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <span onclick="addRowCb()" class="table-add_line">+ Add Line</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>