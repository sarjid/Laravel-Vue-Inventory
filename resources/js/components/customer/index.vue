<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Supplier</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Supplier List
            <router-link to="/add-customer" class="btn btn-sm btn-info " style="float:right;" id="add_new"> Add New</router-link>
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
              <input type="search" v-model="searchTerm" class="form-control" placeholder="search by phone" id="search"> <br>
              <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="customer in filterSearch" :key="customer.id">
                    <td>{{ customer.name }}</td>
                    <td>
                      <img :src="customer.photo" id="photo_size" alt="">
                    </td>
                    <td>{{ customer.phone }}</td>
                    <td>{{ customer.email }}</td>
                    <td>
                      <router-link  :to="{ name:'edit-customer', params:{id: customer.id}}"  class="btn btn-sm btn-info">Edit</router-link>
                      <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger">Delete</a>
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
        if (!User.loggedIn) {
            this.$router.push({ name: '/'})
        }
    },

     created(){
        this.allCustomer()
    },

    data(){
        return{
            customers:[],
            searchTerm:'',
        }
    },

    computed:{
        filterSearch(){
            return this.customers.filter(customer =>{
              return  customer.name.match(this.searchTerm)
            }) 
        }
    },

    methods:{
        allCustomer(){
            axios.get('/api/customer/all/')
            .then(({data}) =>(this.customers = data))
            .catch(console.log('error'))
        },
        deleteCustomer(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete!'
            })
            .then((result) => {
            if (result.value) {
                axios.get('/api/customer/delete/'+id)
                .then(()=>{
                     this.customers = this.customers.filter(customer =>{
                         return customer.id != id
                     })
                })
                .catch(()=>{
                    this.$router.push({ name:'all-customer' })
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