{!!Form::open(['route' => ['insertcb', $client_id], 'id'=>'frmsave2', 'method'=>'POST'])!!}
<div class="body table-responsive">
                        <table class="table table-bordered table-form" width="100">
                            <thead>
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
                            <tbody>
                                <tr v-for="detail in form.details">
                                    <td class="table-item_id" :class="{'table-error': errors['details' + $index + '.item_id']}">
                                    <select class="table-control" name="item_id[]" v-model="detail.item_id">
                                                    <option value="0" selected="true" disabled="true">Choose</option>
                                                @if($items)
                                                @foreach($items as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    
                                    <td class="table-date" :class="{'table-error': errors['details' + $index + '.date']}">
                                        <input type="date" class="table-control" v-model="detail.date" name="date[]">
                                    </td>
                                    <td class="table-vendor" :class="{'table-error': errors['details' + $index + '.vendor']}">
                                        <select class="table-control" name="vendor_id[]" v-model="detail.vendor_id">
                                    <option value="0" selected="true" disabled="true"></option>
                                        @if($vendors)
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                        @endforeach
                                        @endif
                                </select>
                                    </td>
                                    <td class="table-coa_id" :class="{'table-error': errors['details' + $index + '.coa_id']}">
                                    <select class="table-control" name="coa_id[]" v-model="detail.coa_id">
                                                    <option value="0" selected="true" disabled="true">Choose</option>
                                                @if($coas)
                                                @foreach($coas as $coa)
                                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-amount" :class="{'table-error': errors['details' + $index + '.amount']}">
                                        <input type="number" class="table-control" v-model="detail.amount" name="amount[]" step="0.01">
                                    </td>

                                    <td class="table-vat_id" :class="{'table-error': errors['details' + $index + '.vat_id']}">
                                        <select class="table-control" name="vat_id[]" v-model="detail.vat_id">
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
                                    <td class="table-remove">
                                        <input type="hidden" name='client_id[]' value="{{ $client_id }}" class="form-control">
                                        <span @click="remove(detail)" class="table-remove-btn">X</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <input type="button" id ="addLine" @click="addLine" class="table-add_line" value="+ Add Line">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>