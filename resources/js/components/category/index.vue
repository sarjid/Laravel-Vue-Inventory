<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Category</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Category List
            <router-link to="/add-category" class="btn btn-sm btn-info " style="float:right;" id="add_new"> Add New</router-link>
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
              <input type="search" v-model="searchTerm" class="form-control" placeholder="search by phone" id="search"> <br>
              <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="(category,index) in filterSearch" :key="category.id" >
                    <td>{{ index+1 }}</td>
                    <td>{{ category.category_name }}</td>
                    <td>
                      <router-link :to="{name:'edit-category',params:{ id:category.id }}"  class="btn btn-sm btn-info">Edit</router-link>
                      <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger">Delete</a>
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
       this.allCategory();
   },

   data(){
       return{
           categories:[],
           searchTerm:'',
       }
   },

   computed:{
     filterSearch(){
       return this.categories.filter(category =>{
         return category.category_name.match(this.searchTerm)
       })
     }
   },
   methods:{
       allCategory(){
           axios.get('/api/category')
           .then(({data}) =>(this.categories = data))
           .catch(console.log('error'))
       },
       deleteCategory(id){
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
              axios.delete('/api/category/'+id)
              .then(()=>{
               this.categories = this.categories.filter(category =>{
                return category.id != id
               })
              })
              .catch(()=>{
                this.$router.push({ name:'all-category'})
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