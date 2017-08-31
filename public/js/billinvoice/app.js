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
		},

	    create: function() {
	      this.isProcessing = true;
	      this.$http.post('/user/'+ client +'/accounting/journal/', this.form)
	        .then(function(response) {
	          if(response.data.created) {
	            window.location = '/user/'+ client +'/accounting/journal/' + response.data.id;
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
			this.$http.put('/user/'+ client +'/accounting/journal/' + this.form.id, this.form)
				.then(function(response){

					if(response.data.created){
						window.location = '/user/'+ client + 'accounting/journal' + response.data.id;
					} else {
						this.isProcessing = false;
					}
				})
				.catch(function(response){
					this.isProcessing = false;
					Vue.set(this.$data, 'errors', response.data);
					
				})
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