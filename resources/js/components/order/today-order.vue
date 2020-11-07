<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Order list</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Today's Order List
          
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
              <input type="search" v-model="searchTerm" class="form-control" placeholder="search by Total" id="search"> <br>
              <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Total Amount</th>
                    <th>Paying Amount</th>
                    <th>Due Amount</th>
                    <th>Payment</th>
                    <th>Action</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="order in filterSearch" :key="order.id">
                    <td>{{ order.customer.name }}</td>
                    <td>{{ order.total }}</td>
                    <td>{{ order.pay }}</td>
                    <td>{{ order.due }}</td>
                    <td>{{ order.payby }}</td>
                    <td>
                      <router-link  :to="{ name:'view-order', params:{id: order.id}}"  class="btn btn-sm btn-info">View Details</router-link>
                     
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
export default{
    mounted(){
       if (!User.loggedIn()) {
           this.$router.push({ name: '/'})
       } 
    },

    created(){
        this.allOrders();
    },

    data(){
        return{
            orders:[],
            searchTerm:'',
        }
    },

    computed:{
        filterSearch(){
            return this.orders.filter(order => {
                return order.total.match(this.searchTerm)
            })
        }
    },


    methods:{
        allOrders(){
            axios.get('/api/today/all-order')
            .then(({data}) => (this.orders = data))
            .catch(console.log('today order error'))
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