
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Trial Balance
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    
                                    <label>Date: </label>
                                    {{request()->route('end')}}

                                </div>
                            </div>

                        </div>
                        <div class="body table-responsive">
                            <table id="sum_table" class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>                         
                                    <tr id="totals">
                                        <th>Total</th>
                                        <th>
                                        @if($details)
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$details->sum('debit') + $detail->where("credit", 0)->sum('vat_amount')}}
                                        @endif
                                        @endforeach
                                        @endif
                                        </th>
                                        <th>
                                        @if($details)
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$details->sum('credit') + $detail->where("debit", 0)->sum('vat_amount')}}
                                        @endif
                                        @endforeach
                                        @endif
                                        </th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($coas)
                                    @foreach($coas as $coa)
                                    <tr>
                                        <td class="coa">{{$coa->name}}</td>
                                        <td class="deb">
                                        @if($details)
                                        @if($details->where("coa_id", $coa->id))
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$detail->where("coa_id", $coa->id)->sum('debit')}}
                                        @endif
                                        @endforeach
                                        @endif
                                        @endif
                                        </td>
                                        <td class="cred">
                                        @if($details)
                                        @if($details->where("coa_id", $coa->id))
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$detail->where("coa_id", $coa->id)->sum('credit')}}
                                        @endif
                                        @endforeach
                                        @endif
                                        @endif
                                        </td>
                                       
                                    </tr>
                                    
                                   @endforeach
                                   @endif
                                   <tr>
                                        <td>Value Added Tax</td>
                                        <td>
                                        @if($details)
                                        
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$detail->where("credit", 0)->sum('vat_amount')}}
                                        @endif
                                        @endforeach
                                        
                                        @endif
                                        </td>
                                        <td>
                                        @if($details)
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$detail->where("debit", 0)->sum('vat_amount')}}
                                        @endif
                                        @endforeach
    
                                        @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


