<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Invoice No.</label>
                    <input type="text" class="form-control" v-model="form.reference_no">
                    <p v-if="errors.reference_no" class="error">@{{errors.invoice_no[0]}}</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Customer</label>
                    <input type="text" class="form-control" v-model="form.client">
                    <p v-if="errors.client" class="error">@{{errors.client[0]}}</p>
                </div>
            </div>
            <div class="col-sm-4">
                <label>Invoice Date</label>
                <input type="date" class="form-control" v-model="form.invoice_date">
                <p v-if="errors.invoice_date" class="error">@{{errors.invoice_date[0]}}</p>
            </div>
            <div class="col-sm-4">
                <label>Due Date</label>
                <input type="date" class="form-control" v-model="form.due_date">
                <p v-if="errors.due_date" class="error">@{{errors.due_date[0]}}</p>
            </div>
        </div>
    </div>
</div>
<hr>
<div v-if="errors.products_empty">
    <p class="alert alert-danger">@{{errors.products_empty[0]}}</p>
    <hr>
</div>
<table class="table table-bordered table-form">
    <thead>
        <tr>
            <th>Item</th>
            <th>Description</th>
            <th>Price</th>
            <th>Qty</th>
            <th>VAT Code</th>
            <th>VAT Amount
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="product in form.products">
            <td class="table-name" :class="{'table-error': errors['products.' + $index + '.name']}">
            
                <textarea class="table-control" v-model="product.name"></textarea>
            </td>
            <td class="table-name" :class="{'table-error': errors['products.' + $index + '.name']}">
                <textarea class="table-control" v-model="product.name"></textarea>
            </td>
            <td class="table-price" :class="{'table-error': errors['products.' + $index + '.price']}">
                <input type="number" class="table-control"  v-model="product.price">
            </td>
            <td class="table-qty" :class="{'table-error': errors['products.' + $index + '.qty']}">
                <input type="number" class="table-control" v-model="product.qty">
            </td>
            <td class="table-total">
                <span class="table-text">@{{product.qty * product.price}}</span>
            </td>
            <td class="table-remove">
                <span @click="remove(product)" class="table-remove-btn">&times;</span>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td class="table-empty" colspan="2">
                <span @click="addLine" class="table-add_line">Add Line</span>
            </td>
            <td class="table-label">Sub Total</td>
            <td class="table-amount">@{{subTotal}}</td>
        </tr>
    </tfoot>
</table>