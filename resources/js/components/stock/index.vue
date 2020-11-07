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
            Products List
         
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
              <input type="search" v-model="searchTerm" class="form-control" placeholder="search product name" id="search"> <br>
              <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Product Code</th>
                    <th>Category Name</th>
                    <th>Buying Price</th>
                    <th>Stock Status</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="product in filtersearch" :key="product.id">
                    <td>{{ product.product_name }}</td>
                    <td>
                      <img :src="product.image" id="photo_size" alt="">
                    </td>
                    <td>{{ product.product_code }}</td>
                    <td>{{ product.category.category_name }}</td>
                    <td>{{ product.buying_price }}</td>
                    <td v-if="product.product_quantity >= 1"><span class="badge badge-pill badge-success">Availble</span></td>
                    <td v-else=""><span class="badge badge-pill badge-danger">Stock Out</span></td>
                   
                    <td>{{ product.product_quantity }}</td>
                     <td>
                      <router-link :to="{ name:'edit-stock', params:{ id: product.id }}" class="btn btn-sm btn-info">Edit Stock</router-link>
                    </td>
                  </tr>
              
                </tbody>
              </table>
            </div>
          </div>

         
         </div>
       </div>
   </div>
 
</template>

<script type="text/javascript" >
 export default { 
  	mounted(){
            if (!User.loggedIn()) {
               this.$router.push({ name:'/' })
            } 
        },

        created(){
        this.allProduct();
        },

        data(){
          return{
            products:[],
            searchTerm:'',         
          }
        },
       computed:{
         filtersearch(){
          return this.products.filter(product => {
             return product.product_name.match(this.searchTerm)
           })
         }
       },
        methods:{
          allProduct(){
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch()
          },

          deleteProduct(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
             icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
          })
            .then((result) => {
              if (result.value) {
                axios.delete('/api/product/'+id)
                .then(()=>{
                  this.products = this.products.filter(product =>{
                    return product.id !=id
                  })
                })
                .catch(()=>{
                  this.$router.push({ name: 'all-product' })
                })
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })
        }
  }  
  
}
</script>

<style>
#photo_size{
  height: 50px;
  width: 50px;
}
#search{
  width: 200px;

}
</style>