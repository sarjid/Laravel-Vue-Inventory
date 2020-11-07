<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Update Category</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Update Category 
            <router-link to="/all-category" class="btn btn-sm btn-info " style="float:right;" id="add_new"> All Category</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="categoryUpdate">
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
               <button type="submit" class="btn btn-info mt-3">Update Now</button>
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

     created(){
         let id = this.$route.params.id
         axios.get('/api/category/'+id)
         .then(({data}) => (this.form = data))
         .catch(console.log('error'))
     },
     methods:{
        //  categoryInsert(){
        //   axios.post('/api/category/',this.form)
        //   .then(()=>{
        //       Notification.success();
        //       this.$router.push({ name: 'all-category'})
        //   })
        //   .catch(error => this.errors = error.response.data.errors)
        // }

        categoryUpdate(){
            let id = this.$route.params.id
            axios.patch('/api/category/'+id,this.form)
            .then(()=>{
                Notification.update()
                this.$router.push({ name: 'all-category' })
            })
            .catch(error => this.errors =error.response.data.errors )
        }
     }
 }
</script>

<style>
</style>