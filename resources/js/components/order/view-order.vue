<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Order Details</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Order          
          </div>
          
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="list-group mt-2">
                            <a href="#" class="list-group-item list-group-item-action bg-info text-white">
                                Customer Details
                            </a>
                            <a href="#" class="list-group-item list-group-item-action"><strong>Name:</strong> {{ order.customer.name }}</a>
                            <a href="#" class="list-group-item list-group-item-action"><strong>Phone:</strong> {{ order.customer.phone }}</a>
                            <a href="#" class="list-group-item list-group-item-action"><strong>Email:</strong> {{ order.customer.email }}</a>
                            <a href="#" class="list-group-item list-group-item-action"><strong>Address:</strong> {{ order.customer.address }}</a>
                           
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="list-group mt-2">
                            <a href="#" class="list-group-item list-group-item-action bg-info text-white">
                               Order Details
                            </a>
                            <a href="#" class="list-group-item list-group-item-action"><strong>Sub Total: </strong>{{ order.sub_total }} tk</a>
                            <a href="#" class="list-group-item list-group-item-action"><strong>Vat: </strong>{{ order.vat }}% ({{ order.sub_total * order.vat /100 }} tk)</a>
                            <a href="#" class="list-group-item list-group-item-action"><strong>Total: </strong>{{ order.total }} tk</a>
                            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true"><strong>Pay Amount: </strong>{{ order.pay }} tk</a>
                            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true"><strong>Due Amount: </strong>{{ order.due }} tk</a>
                        </div>
                    </div>

                </div>
            </div>        
         </div>

          <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Order Details
          
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
    
              <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="detail in details" :key="detail.id">
                    <td>
                        <img :src="'/'+detail.product.image" id="photo_size" alt="">
                    </td>
                    <td>{{ detail.product.product_name }}</td>
                    <td>{{ detail.product.product_code }}</td>
                    <td>{{ detail.pro_quantity }}</td>
                    <td>{{ detail.product_price }}</td>
                    <td>{{ detail.sub_total }}</td>
                    
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
export default{
    mounted(){
       if (!User.loggedIn()) {
           this.$router.push({ name: '/'})
       } 
    },


   
    data(){
        return{
            order:[],
            details:[],
        }
    },

     created(){      
        let id = this.$route.params.id

        axios.get('/api/order/details/'+id)
        .then(({data}) => (this.order = data))
        .catch(console.log('deatils order error'))

        axios.get('/api/order/details/product/'+id)
        .then(({data}) => (this.details = data))
        .catch(console.log('error order details'))
    },


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