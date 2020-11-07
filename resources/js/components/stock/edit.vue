<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Update Stocks</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
           Update Your Stocks 
          
          </div>
          <div class="card-body">
          	  <form @submit.prevent="stockUpdate">
                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-4 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.product_name">
					  <span class="text-danger text-center" v-if="errors.product_name">{{ errors.product_name[0] }}</span>
	                  <label for="firstName">Product Name</label>
	                </div>
	               </div>
	           
				    <div class="col-md-4 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.root" >
					  <span class="text-danger text-center" v-if="errors.root">{{ errors.root[0] }}</span>
	                  <label for="lastName">Root</label>
	                </div>
	               </div>

                        <div class="col-md-4 mt-2">
	                <div class="form-label-group">
	                  <input type="number" class="form-control" v-model="form.product_quantity">
					  <span class="text-danger text-center" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</span>
	                  <label for="nid">Product Quantity</label>
	                </div>
	               </div>
	             </div>
	          </div>

               <button type="submit" class="btn btn-info mt-3">Update Quantity</button>
              </form>
          </div>
         </div>
       </div>
   </div>
 
</template>

<script type="text/javascript" >
 export default { 
  mounted(){
    if (!User.loggedIn()) {
      this.$router.push({name : '/'})
    }
  },
  data(){
    return {
      form:{
        product_name: '',
        product_code: '',
        root: '',
        product_quantity: '',
      },
      errors:{},
    }
  },

	methods:{
		stockUpdate(){
            let id = this.$route.params.id
			axios.post('/api/stock/update/'+id,this.form)
			.then(() =>{
				Notification.update()
				this.$router.push({ name: 'product-stock' })
				
			})
			.catch(error => this.errors = error.response.data.errors)
        },
    
	},

	created(){
         let id = this.$route.params.id
        axios.get('/api/product/'+id)
        .then(({data}) => (this.form = data))
        .catch(console.log('error'))
       
	}

}
</script>

<style>
</style>