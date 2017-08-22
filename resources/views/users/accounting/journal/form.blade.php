<div class="row">

	<div class="col-sm-12">

		<input type="hidden" value="{{ $client_id }}" class="form-control">

		<div class="col-sm-4">
			<div class="form-group">
				<label>Transaction No.</label>
				<input type="text" class="form-control" v-model="form.journal">
				<p v-if="errors.transaction_no" class="error">@{{ errors.transaction_no}}</p>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Date</label>
				<input type="date" class="form-control" v-model="form.date">
				<p v-if="errors.date" class="error">@{{ errors.date}}</p>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Description</label>
				<textarea class="form-control" v-model="form.description"></textarea>
				<p v-if="errors.description" class="error">@{{ errors.description}}</p>
			</div>
		</div>
@include('includes.form_error')
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
					<th>Person</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="detail in form.details">
					<td class="table-reference_no" :class="{'table-error': errors['details' + $index + '.reference_no']}">
						<input id="reference_no" type="text" name="reference_no[]" class="table-control" v-model="detail.reference_no">
					</td>
					<td class="table-client_coa_id" :class="{'table-error': errors['details' + $index + '.client_coa_id']}">
						<input type="text" class="table-control" v-model="detail.client_coa_id">
					</td>
					<td class="table-debit" :class="{'table-error': errors['details' + $index + '.debit']}">
						<input type="number" class="table-control" v-model="detail.debit">
					</td>
					<td class="table-credit" :class="{'table-error': errors['details' + $index + '.credit']}">
						<input type="number" class="table-control" v-model="detail.credit">
					</td>
					<td class="table-description" :class="{'table-error': errors['details' + $index + '.description']}">
						<input type="text" class="table-control" v-model="detail.description">
					</td>
					<td class="table-vat_id" :class="{'table-error': errors['details' + $index + '.vat_id']}">
						<input type="text" class="table-control" v-model="detail.vat_id">
					</td>
					<td class="table-vat_amount" :class="{'table-error': errors['details' + $index + '.vat_amount']}">
						<input type="number" class="table-control" v-model="detail.vat_amount">
					</td>
					<td class="table-vendor_id" :class="{'table-error': errors['details' + $index + '.vendor_id']}">
						<input type="text" class="table-control" v-model="detail.vendor_id">
					</td>
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
					<td class="table-debittot">@{{ debitTot }}</td>
					<td class="table-credittot">@{{ creditTot }}</td>
				</tr>
			</tfoot>
		</table>
	</div>
