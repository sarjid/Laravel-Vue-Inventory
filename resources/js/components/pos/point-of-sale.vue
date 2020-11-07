<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">point of sale</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-5 col-md-5">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Sell Product 
              <a class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#exampleModal" id="add_new"> Add Customer</a>
          </div>         
            <div class="card-body">
                       <table class="table table-sm table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="cart in cartproducts" :key="cart.id">
                            <th>{{ cart.pro_name }}</th>
                            <td>
                              <button @click="incrementCart(cart.id)" class="btn btn-sm btn-info">+</button>
                              <input type="text" readonly="" :value="cart.pro_quantity" style="width: 20px;" >
                              <button  @click="decrementCart(cart.id)" class="btn btn-sm btn-info" v-if="cart.pro_quantity >= 2">-</button>
                              <button class="btn btn-sm btn-info" v-else="" disabled >-</button>
                            </td>
                            <td>{{ cart.pro_price }}</td>
                            <td>{{ cart.sub_total }}</td>
                            <td><a @click="removeCartItem(cart.id)" class=" btn-sm btn-danger">X</a></td>
                          </tr>
                         
                        </tbody>
                      </table>
                      <hr>
                    </div>
                    <div class="card-footer">
                      <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                         Total Quantity:
                          <strong>{{ qty }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                         Sub Total:
                          <strong>{{ subtotal }} Tk</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Vat:
                         <strong>{{vats.vat}}% ( {{ subtotal*vats.vat/100 }} tk ) </strong>
                        </li>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                          Total:
                         <strong>{{ subtotal*vats.vat/100 + subtotal }} Tk</strong>
                        </li>
                      </ul>
                      <br>
                    <form @submit.prevent="orderDone" >
                      <label>Customer Name</label>
                      <select class="form-control" v-model="customer_id" >
                         <option :value="customer.id" v-for="customer in customers" >{{ customer.name }}</option>
                      </select>

                      <label>Pay</label>
                      <input type="text" class="form-control" v-model="pay" required="" placeholder="pay amount">

                      <label>Due</label>
                      <input type="text" class="form-control" v-model="due" required="" placeholder="due amount">

                      <label>Pay By </label>
                      <select class="form-control" v-model="payby" >
                         <option value="HandCash">Hand Cash</option>
                         <option value="Cheaque">Cheaque</option>
                         <option value="GiftCard">Gift Card</option>
                      </select>

                      <br>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                  </div>     
            </div>

      <!--customer add modal--> 
             <!-- Modal -->
             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
               <div class="modal-dialog" role="document">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">             
                    <form @submit.prevent="customerInsert" enctype="multipart/form-data">
                      <div class="form-group">
                      <div class="form-row">
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="text" class="form-control" v-model="form.name"  required="">
                          <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
                          <label for="firstName">Full Name</label>
                        </div>
                       </div>
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="text" v-model="form.email" class="form-control" >
                          <span class="text-danger" v-if="errors.email">{{ errors.email[0] }}</span>
                          <label for="lastName">Email Address</label>
                        </div>
                       </div>
                     </div>
                  </div>
                  <div class="form-group">
                      <div class="form-row">
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="text" class="form-control" v-model="form.address" required="">
                          <span class="text-danger" v-if="errors.address">{{ errors.address[0] }}</span>
                          <label for="firstName">Address</label>
                        </div>
                       </div>
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="text" v-model="form.phone" class="form-control"  required="">
                          <span class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</span>
                          <label for="lastName">Phone</label>
                        </div>
                       </div>
                     </div>
                  </div>
                     <div class="form-group">
                      <div class="form-row">
                       <div class="col-md-6">
                        <div class="form-label-group">
                         <input type="file" class="btn"  @change="onFileselected">
                          <span class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</span>
                        </div>
                       </div>
                        <div class="col-md-6">
                          <img :src="form.photo" style="height:40px; width: 40px;">
                        </div>
                     </div>
                  </div>
                <button type="submit" class="btn btn-success">Insert</button>
               
                  </form>
          
                   </div>
                 </div>
               </div>
             </div>
             <!--end customer modal-->

         <div class="card col-lg-7 col-md-7">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            All Products
          </div>         
            <div class="card-body">

              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All Product</a>
                 </li>

                 <li class="nav-item" v-for="category in categories" :key="category.id">
                   <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" @click="subproduct(category.id)">{{ category.category_name }}</a>
                 </li>

               </ul>
               <div class="tab-content" id="pills-tabContent">

                 <div class="tab-pane fade show active" id="pills-home"  role="tabpanel" aria-labelledby="pills-home-tab">
                  <input type="text" v-model="searchTerm" class="form-control" placeholder="search"><br>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 col-sm-6 mt-2" v-for="product in filtersearch" :key="product.id" >
                          <a href="#" @click.prevent="AddToCart(product.id)" class="decoration" >
                              <div class="card" style="width: 9rem; height: 180px;">
                              <img :src="product.image" class="card-img-top m-auto" style="height: 70px; width: 70px;">
                              <div class="card-body">
                                <strong class="card-title text-center">${{ product.selling_price }}</strong> <br>
                                <small class="card-title text-center">{{ product.product_name }}</small> <br>
                                <span class="badge badge-success text-center" v-if="product.product_quantity >= 1"> Aviable ({{ product.product_quantity }})</span>
                                <span v-else="" class="badge badge-danger text-center">Stock Out Product</span>
                              </div>
                            </div>
                          </a>
                        </div>
                    </div>
                 </div>

                 <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"> 
                  <input type="text" v-model="getsearchTerm" class="form-control" placeholder="search"><br>
                  <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 mt-2" v-for="product in getfiltersearch" :key="product.id">                         
                            <a href="#" @click.prevent="AddToCart(product.id)" class="decoration">
                              <div class="card" style="width: 9rem; height: 180px;">
                              <img :src="product.image" class="card-img-top m-auto" style="height: 70px; width: 70px;">
                              <div class="card-body">
                                <strong class="card-title text-center">${{ product.selling_price }}</strong> <br>
                                <small class="card-title text-center">{{ product.product_name }}</small> <br>
                                <span class="badge badge-success text-center" v-if="product.product_quantity >= 1"> Aviable ({{ product.product_quantity }})</span>
                                <span v-else="" class="badge badge-danger text-center">Product Stock Out</span>
                              </div>
                            </div>
                          </a>
                        </div>
                    </div>   
                 </div>
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
        this.allCategory();
        this.allCustomer();
        Reload.$on('customerAfterAdd', ()=> {
          this.allCustomer();
        })
        this.getCartProduct();
        Reload.$on('AfterAdd', ()=>{
          this.getCartProduct();
        })
        this.vat();
        
        },

        data(){
          return{
            form:{
              name:'',
              email:'',
              phone:'',
              address:'',
              photo:'',
            },
            customer_id:'',
            pay:'',
            due:'',
            payby:'',
            products:[],
            categories:[],
            getproducts:[],
            customers:'',
            searchTerm:'',   
            getsearchTerm:'',
            cartproducts:'',
            vats:'',
            errors:{}     
          }
        },
       computed:{
         filtersearch(){
          return this.products.filter(product => {
             return product.product_name.match(this.searchTerm)
           })
         },

          getfiltersearch(){
          return this.getproducts.filter(getproduct => {
             return getproduct.product_name.match(this.getsearchTerm)
           })
         },
        //  cart total Quantity 
        qty(){
          let sum = 0;
          for (let i = 0; i < this.cartproducts.length; i++) {
            sum += (parseFloat(this.cartproducts[i].pro_quantity))
          }
          return sum;
        },
        subtotal(){
          let sum = 0;
          for(let i = 0; i < this.cartproducts.length; i++){
            sum += (parseFloat(this.cartproducts[i].pro_quantity) * (parseFloat(this.cartproducts[i].pro_price)))
          }
          return sum;
        },


       },
        methods:{
          allProduct(){
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch()
          },

          allCategory(){
            axios.get('/api/category/')
            .then(({data}) => (this.categories = data ))
            .catch(console.log('error'))
          },
          subproduct(id){
            axios.get('/api/getting/category/product/'+id)
            .then(({data}) => (this.getproducts = data))
            .catch(console.log('category product error'))
          },
          allCustomer(){
             axios.get('/api/customer/all/')
            .then(({data}) =>(this.customers = data))
            .catch(console.log('error'))
          },
          onFileselected(){
              let file = event.target.files[0];
             if (file.size > 1048770) {
                 Notification.image_validation()
             }else{
                 let reader = new FileReader();
                 reader.onload = event =>{
                     this.form.photo = event.target.result
                     console.log(event.target.result);
                 }
                 reader.readAsDataURL(file)
             }
          },

          customerInsert(){
            axios.post('/api/customer/store',this.form)
            .then(()=>{
              $('#closeModal').click();
              Reload.$emit('customerAfterAdd')
              Notification.success()
              //  this.customers = this.customers.filter(customer =>{
              //       return customer.id != id
              //    })
  
            })
            .catch(error=> this.errors = error.response.data.errors)

          },

          // -------------- start cart methods---------
          AddToCart(id){
           axios.post('/api/addToCart/'+id)
           .then(()=> {
             Reload.$emit('AfterAdd')
             Notification.cart_success()
           })
           .catch(console.log('not added cart error'))
          },
          getCartProduct(){
            axios.get('/api/getCartProduct')
            .then(({data}) => (this.cartproducts = data))
            .catch(console.log('error, cart product not found'))
          },
          removeCartItem(id){
            axios.get('/api/cart/remove/'+id)
            .then(()=>{
              Reload.$emit('AfterAdd')
              Notification.cart_remove();
            })
            .catch(console.log('cart remove error'))
          },
          
          incrementCart(id){
            axios.get('/api/cart/increment/'+id)
            .then(()=> {
              Reload.$emit('AfterAdd')
              Notification.cart_increment();
            })
            .catch(console.log('erro increment'))
          },

          decrementCart(id){
            axios.get('/api/cart/decrement/'+id)
            .then(()=> {
              Reload.$emit('AfterAdd')
              Notification.cart_decrement();
            })
            .catch(console.log('erro increment'))
          },
          // ----------------- end cart ------------------- 
        // total Quantity subtotal vat 
      vat(){
        axios.get('/api/vat')
        .then(({data}) => { this.vats = data})
        .catch()
      }
      ,
      orderDone(){
        let total = this.subtotal*this.vats.vat/100 + this.subtotal;
        let data = {qty:this.qty, subtotal:this.subtotal, vat:this.vats.vat, total:total, customer_id:this.customer_id, pay:this.pay, due:this.due, payby:this.payby}
        axios.post('/api/orderdone/',data)
        .then(()=> {
          Notification.order_success();
          this.$router.push({ name: 'today-order'})
        })
        .catch(console.log('order not done error'))
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
.decoration{
  text-decoration-line: none;
  color: black;
}

a:hover{
    text-decoration-line: none;
    color: red;
    cursor: pointer;

}

</style>