<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Search Order</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
             <div class="row">
                 <div class="col-lg-4">
                      <div class="card-header">
                        <i class="fas fa-chart-area"></i>
                     Search By Date 
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="searchDate">
                            <div class="form-group">
                            <div class="form-row">
                            <div class="col-md-12 mt-2">
                                <div class="form-label-group">
                                <input type="date" class="form-control" v-model="order_date">
                              
                                <label for="firstName">Order Date</label>
                                </div>
                            </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">Search</button>
                        </form>
                    </div>
                 </div>

               

                  <div class="col-lg-4">
                      <div class="card-header">
                        <i class="fas fa-chart-area"></i>
                      Search By Year
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="searchYear">
                            <div class="form-group">
                            <div class="form-row">
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Select Year</label>
                                    <select  class="form-control" id="exampleFormControlSelect2" v-model="search_year">
                                        <option value="2020">2020</option>
                                        <option value="2019">2019</option>
                                        <option value="2018">2018</option>                                      
                                    </select>
		                        </div>
                            </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">Search</button>
                        </form>
                    </div>
                 </div>

                   <div class="col-lg-4">
                      <div class="card-header">
                        <i class="fas fa-chart-area"></i>
                      Search By Month
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="searchMonth">
                            <div class="form-group">
                            <div class="form-row">
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Select Month</label>
                                    <select  class="form-control" id="exampleFormControlSelect2" v-model="order_month">
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="june">june</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
		                        </div>
                            </div>

                             <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Select Year</label>
                                    <select  class="form-control" id="exampleFormControlSelect2" v-model="order_year">
                                        <option value="2020">2020</option>
                                        <option value="2019">2019</option>
                                        <option value="2018">2018</option>                                      
                                    </select>
		                        </div>
                            </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info ">Search</button>
                        </form>
                    </div>
                 </div>


             </div>
         </div>

         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
             Order List          
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
            
              <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Total Amount</th>
                    <th>Qty</th>
                    <th>Pay</th>
                    <th>Due</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>View</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="order in orders" :key="order.id">
                    <td>{{ order.customer.name }}</td>
                    <td>{{ order.total }}</td>
                    <td>{{ order.qty }}</td>
                    <td>{{ order.pay }}</td>
                    <td>{{ order.due }}</td>
                    <td>{{ order.payby }}</td>
                    <td>{{ order.order_date }}</td>
                    <td>
                      <router-link  :to="{ name:'view-order', params:{id: order.id}}"  class="btn btn-sm btn-info">View Details</router-link>
                     
                    </td>
                  </tr>
              
                </tbody>
                 <tfoot>
                  <tr>
                    <th></th>
                    <th>Total: {{ Total }} tk</th>
                    <th>{{ Quantity }} Pices</th>
                    <th>Total: {{ Pay }} tk</th>
                    <th>Total: {{ Due }} tk</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
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
         if (!User.loggedIn) {
             this.$router.push({ name: '/'})
         }
     },
     data(){
         return{        
              orders:'',
              order_date:'',
              search_year:'',  
              order_month:'',  
              order_year:'' 
         }
        
     },

       computed:{        
            //  cart total Quantity 
            Quantity(){
            let sum = 0;
            for (let i = 0; i < this.orders.length; i++) {
                sum += (parseFloat(this.orders[i].qty))
            }
            return sum;
            },
            Total(){
            let sum = 0;
            for (let i = 0; i < this.orders.length; i++) {
                sum += (parseFloat(this.orders[i].total))
            }
            return sum;
            },
            Pay(){
            let sum = 0;
            for (let i = 0; i < this.orders.length; i++) {
                sum += (parseFloat(this.orders[i].pay))
            }
            return sum;
            },
            Due(){
            let sum = 0;
            for (let i = 0; i < this.orders.length; i++) {
                sum += (parseFloat(this.orders[i].due))
            }
            return sum;
            }
        },
       

     methods:{
        searchDate(){
            let data = {order_date:this.order_date}
            axios.post('/api/order/search/date',data)
            .then(({data})=> { this.orders = data })
            .catch(error => this.errors = error.response.data.errors)
        },
       
        searchYear(){
            let data = {search_year:this.search_year}
            axios.post('/api/order/search/year',data)
            .then(({data})=> { this.orders = data })
            .catch(error => this.errors = error.response.data.errors)
        },
         searchMonth(){
            let data = {order_month:this.order_month, order_year:this.order_year}
            axios.post('/api/order/search/month',data)
            .then(({data})=> { this.orders = data })
            .catch(error => this.errors = error.response.data.errors)
        }
     }
 }
</script>

<style>
</style>