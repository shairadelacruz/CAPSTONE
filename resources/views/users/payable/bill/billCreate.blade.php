{!!Form::open(['route' => ['insertbill', $client_id], 'id'=>'frmsave', 'method'=>'POST'])!!}
                                           
                <div class="row">

                    <div class="col-sm-12">

                        <input type="hidden" name='client_id' value="{{ $client_id }}" class="form-control">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Reference No.</label>
                                <input type="text" class="form-control" v-model="form.reference_no" name='reference_no'>
                                <p v-if="errors.reference_no" class="error">@{{ errors.reference_no}}</p>
                            </div>
                            <div class="form-group">
                                <label>Vendor</label>
                                <select class="table-control chosen-select" name="vendor_id" v-model="detail.vendor_id">
                                    <option value="0" selected="true" disabled="true"></option>
                                        @if($vendors)
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                        @endforeach
                                        @endif
                                </select>
                                <p v-if="errors.vendor_id" class="error">@{{ errors.vendor_id}}</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Bill Date</label>
                                <input type="date" class="form-control" v-model="form.bill_date" name='bill_date' value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                <p v-if="errors.bill_date" class="error">@{{ errors.bill_date}}</p>
                            </div>
                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" class="form-control" v-model="form.due_date" name='due_date' value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                <p v-if="errors.due_date" class="error">@{{ errors.due_date}}</p>
                            </div>
                        </div>
                
                    </div>

                </div>

                    
                    <div class="body table-responsive">
                        <table class="table table-bordered table-form" width="100">
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="detail in form.details">
                                    <td class="table-item_id" :class="{'table-error': errors['details' + $index + '.item_id']}">
                                    <select class="table-control chosen-select" name="item_id[]" v-model="detail.item_id">
                                                    <option value="0" selected="true" disabled="true">Choose</option>
                                                @if($items)
                                                @foreach($items as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-coa_id" :class="{'table-error': errors['details' + $index + '.coa_id']}">
                                    <select class="table-control chosen-select" name="coa_id[]" v-model="detail.coa_id">
                                                    <option value="0" selected="true" disabled="true">Choose</option>
                                                @if($coas)
                                                @foreach($coas as $coa)
                                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-descriptions" :class="{'table-error': errors['details' + $index + '.descriptions']}">
                                        <input type="text" class="table-control" v-model="detail.descriptions" name="descriptions[]">
                                    </td>
                                    <td class="table-qty" :class="{'table-error': errors['details' + $index + '.qty']}">
                                        <input type="number" class="table-control" v-model="detail.qty" name="qty[]">
                                    </td>
                                    <td class="table-price" :class="{'table-error': errors['details' + $index + '.price']}">
                                        <input type="number" class="table-control" v-model="detail.price" name="price[]" step="0.01">
                                    </td>

                                    <td class="table-vat_id" :class="{'table-error': errors['details' + $index + '.vat_id']}">
                                        <select class="table-control chosen-select" name="vat_id[]" v-model="detail.vat_id">
                                                    <option value="0" selected="true" disabled="true">Choose</option>
                                                @if($vats)
                                                @foreach($vats as $vat)
                                                    <option value="{{$vat->id}}">{{$vat->vat_code}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                    </td>
                                    <td class="table-vat_amount" :class="{'table-error': errors['details' + $index + '.vat_amount']}" step="0.01">
                                        <input type="number" class="table-control" v-model="detail.vat_amount" name="vat_amount[]">
                                    </td>
                                    <td class="table-total" :class="{'table-error': errors['details' + $index + '.total']}">
                                        <input type="number" value="@{{ detail.qty * detail.price +detail.vat_amount/100 * detail.qty * detail.price }}" class="table-control" v-model="detail.total" name="total[]" step="0.01">
                                    </td>
                                    <td class="table-remove">
                                        <span @click="remove(detail)" class="table-remove-btn">X</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <input type="button" id ="addLine" @click="addLine" class="table-add_line" value="+ Add Line">
                                    </td>
                                    <td>Total</td>
                                    <td class="table-grandTotal right-align-text"><input type="number" value="@{{ grandTotal }}" class="table-control" v-model="detail.grandTotal" name="grandTotal" readonly="true" step="0.01"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>