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
            <router-link to="/add-supplier" class="btn btn-sm btn-info " style="float:right;" id="add_new"> Add New</router-link>
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
                    <th>Shop Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="supplier in filterSearch" :key="supplier.id">
                    <td>{{ supplier.name }}</td>
                    <td>
                      <img :src="supplier.photo" id="photo_size" alt="">
                    </td>
                    <td>{{ supplier.phone }}</td>
                    <td>{{ supplier.email }}</td>
                    <td>{{ supplier.shopname }}</td>
                    <td>
                      <router-link  :to="{ name:'edit-supplier', params:{id: supplier.id}}"  class="btn btn-sm btn-info">Edit</router-link>
                      <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</a>
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
        this.allsupplier()
    },

    data(){
        return{
            suppliers:[],
            searchTerm:'',
        }
    },

    computed:{
        filterSearch(){
            return this.suppliers.filter(supplier =>{
              return  supplier.name.match(this.searchTerm)
            }) 
        }
    },

    methods:{
        allsupplier(){
            axios.get('/api/supplier/')
            .then(({data}) =>(this.suppliers = data))
            .catch(console.log('error'))
        },
        deleteSupplier(id){
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
                axios.delete('/api/supplier/'+id)
                .then(()=>{
                     this.suppliers = this.suppliers.filter(supplier =>{
                         return supplier.id != id
                     })
                })
                .catch(()=>{
                    this.$router.push({ name:'all-supplier' })
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