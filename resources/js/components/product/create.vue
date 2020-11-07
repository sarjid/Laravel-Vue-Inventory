<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Add New Products 
            <router-link to="/all-product" class="btn btn-sm btn-info " style="float:right;" id="add_new"> All Products</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="productInsert"  enctype="multipart/form-data">
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
	                  <input type="text"  class="form-control" v-model="form.product_code" >
					  <span class="text-danger text-center" v-if="errors.product_code">{{ errors.product_code[0] }}</span>
	                  <label for="lastName">Product Code</label>
	                </div>
	               </div>

				    <div class="col-md-4 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.root" >
					  <span class="text-danger text-center" v-if="errors.root">{{ errors.root[0] }}</span>
	                  <label for="lastName">Root</label>
	                </div>
	               </div>
	             </div>
	          </div>
	          <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.buying_price" >
					  <span class="text-danger text-center" v-if="errors.buying_price">{{ errors.buying_price[0] }}</span>
	                  <label for="firstName">Buying Price</label>
	                </div>
	               </div>
	               <div class="col-md-6 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.selling_price">
					  <span class="text-danger text-center" v-if="errors.selling_price">{{ errors.selling_price[0] }}</span>
	                  <label for="lastName">Selling Price</label>
	                </div>
	               </div>
	             </div>
	          </div>
	          <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6 mt-2">
	                <div class="form-label-group">
	                  <input type="date" class="form-control" v-model="form.buying_date" autofocus="autofocus" >
					  <span class="text-danger text-center" v-if="errors.buying_date">{{ errors.buying_date[0] }}</span>
	                  <label for="firstName">Buying Date</label>
	                </div>
	               </div>
	               <div class="col-md-6 mt-2">
	                <div class="form-label-group">
	                  <input type="number" class="form-control" v-model="form.product_quantity">
					  <span class="text-danger text-center" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</span>
	                  <label for="nid">Product Quantity</label>
	                </div>
	               </div>
	               
	             </div>
	          </div>

                <div class="">
	              <div class="form-row">
	               <div class="col-md-6 mt-2">
	               <div class="form-group">
					    <label for="exampleFormControlSelect1">Category</label>
					    <select class="form-control" v-model="form.category_id" id="exampleFormControlSelect1">
					      <option v-for="category in categories" :value="category.id" >{{ category.category_name}}</option>
					    </select>
					  <span class="text-danger text-center" v-if="errors.category_id">{{ errors.category_id[0] }}</span>
					  </div>
	               </div>
	               <div class="col-md-6 mt-2">
	              <div class="form-group">
					    <label for="exampleFormControlSelect1">Supplier</label>
					    <select class="form-control" v-model="form.supplier_id" id="exampleFormControlSelect1">
					      <option v-for="supplier in suppliers" :value="supplier.id">{{ supplier.name}}</option>
					    </select>
					  <span class="text-danger text-center" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</span>
					  </div>
	               </div>
	               
	             </div>
	          </div>
        
	              <div class="form-row">
	               <div class="col-md-6 mt-2">
	                <div class="form-label-group">
	                 <input type="file" class="form-control" @change="onFileSelected" >
					  <span class="text-danger text-center" v-if="errors.image">{{ errors.image[0] }}</span>
	                </div>
	               </div>
	                <div class="col-md-6 mt-2">
	                	<img :src="form.image" style="height:80px; width: 80px;">
	                </div>
	             </div>

               <button type="submit" class="btn btn-info mt-3">Add Product</button>
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
		category_id: '',
		supplier_id: '',
        product_name: '',
        product_code: '',
        root: '',
        buying_price: '',
        selling_price: '',
        buying_date: '',
        image: '',
        product_quantity: '',
      },
      errors:{},
      categories:{},
      suppliers:{},
    }
  },

	methods:{
		onFileSelected(event){
			let file = event.target.files[0];
			if (file.size > 1048770) {
				Notification.image_validation()
			}else{
				let reader = new FileReader();
				reader.onload = event => {
					this.form.image = event.target.result
				},
				reader.readAsDataURL(file);
			}
		},
		productInsert(){
			axios.post('/api/product/',this.form)
			.then(() =>{
				Notification.success()
				this.$router.push({ name: 'all-product' })
				
			})
			.catch(error => this.errors = error.response.data.errors)
		}
	},

	created(){
		axios.get('/api/category')
		.then(({data}) =>(this.categories = data))
		.catch(console.log('error'))

		axios.get('/api/supplier')
		.then(({data}) => (this.suppliers = data ))
		.catch(console.log('error'))
	}

}
</script>

<style>
</style>