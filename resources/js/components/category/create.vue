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
            Add New Category 
            <router-link to="/all-category" class="btn btn-sm btn-info " style="float:right;" id="add_new"> All Category</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="categoryInsert">
                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-12 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.category_name">
					  <span class="text-danger text-center" v-if="errors.category_name">{{ errors.category_name[0] }}</span>
	                  <label for="firstName">Category Name</label>
	                </div>
	               </div>
	             </div>
	          </div>
               <button type="submit" class="btn btn-info mt-3">Add Now</button>
              </form>
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
             form:{
                 category_name:'',             
             },
              errors:{},
         }
        
     },
     methods:{
         categoryInsert(){
          axios.post('/api/category/',this.form)
          .then(()=>{
              Notification.success();
              this.$router.push({ name: 'all-category'})
          })
          .catch(error => this.errors = error.response.data.errors)
        }
     }
 }
</script>

<style>
</style>