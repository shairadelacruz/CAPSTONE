var app = new Vue({

	el: '#journal',

	data: {

		form: {},

		errors: {},

		isProcessing: false,
	},

	created: function() {
		Vue.set(this.$data, 'form', _form);
	},

	methods: {
		addLine: function() {

			this.form.details.push({reference_no: '', debit: 0, credit: 0, vat_amount: 0})
		},

		remove: function(detail) {
			this.form.details.$remove(detail);
		},

		create: function() {
			this.isProcessing = true;
			this.$http.post('/ames/public/user/1/accounting/journal/', this.form)
				.then(function(response){

					if(response.data.created){
						window.location = '/ames/public/user/1/accounting/journal/' + response.data.id;
					} else {
						this.isProcessing = false;
					}
				})
				.catch(function(response){
					this.isProcessing = false;
					Vue.set(this.$data, 'errors', response.data);
					
				})
		},

		update: function() {
			this.isProcessing = true;
			this.$http.put('/ames/public/user/'+ client +'/accounting/journal/' + this.form.id, this.form)
				.then(function(response){

					if(response.data.created){
						window.location = '/ames/public/user/'+ client + 'accounting/journal' + response.data.id;
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
		debitTot: function(){
			return this.form.details.reduce(function(carry, detail){
				return carry + Number(detail.debit);
			}, 0);
		},

		creditTot: function(){
			return this.form.details.reduce(function(carry, detail){
				return carry + Number(detail.credit);
			}, 0);
		}
	}

})