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
      this.form.details.push({ price: 0, qty: 1, vat_amount: 0})
    },
    remove: function(detail) {
      this.form.details.$remove(detail);
    }
  },
  computed: {

    grandTotal: function(){
      return this.form.details.reduce(function(prev, detail){
        return prev + Number(detail.qty * detail.price +detail.vat_amount/100 * detail.qty * detail.price) ;

      }, 0);
    }
  }
})