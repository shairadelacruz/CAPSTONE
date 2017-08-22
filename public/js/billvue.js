var app = new Vue({
  el: '#bill',
  data: {
    isProcessing: false,
    form: {},
    errors: {}
  },
  created: function () {
    Vue.set(this.$data, 'form', _form);
  },
  methods: {
    addLine: function() {
      this.form.details.push({ price: 0, qty: 1});
    },
    remove: function(detail) {
      this.form.details.$remove(detail);
    }/*,
    create: function() {
      this.isProcessing = true;
      this.$http.post('/invoices', this.form)
        .then(function(response) {
          if(response.data.created) {
            window.location = '/invoices/' + response.data.id;
          } else {
            this.isProcessing = false;
          }
        })
        .catch(function(response) {
          this.isProcessing = false;
          Vue.set(this.$data, 'errors', response.data);
        })
    },
    update: function() {
      this.isProcessing = true;
      this.$http.put('/invoices/' + this.form.id, this.form)
        .then(function(response) {
          if(response.data.updated) {
            window.location = '/invoices/' + response.data.id;
          } else {
            this.isProcessing = false;
          }
        })
        .catch(function(response) {
          this.isProcessing = false;
          Vue.set(this.$data, 'errors', response.data);
        })
    }*/
  },
  computed: {
    subTotal: function() {
      return this.form.products.reduce(function(carry, product) {
        return carry + (parseFloat(product.qty) * parseFloat(product.price));
      }, 0);
    },
    grandTotal: function() {
      return this.subTotal - parseFloat(this.form.discount);
    }
  }
})