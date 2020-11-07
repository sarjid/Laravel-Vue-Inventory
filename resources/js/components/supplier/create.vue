<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Suppliers</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Suppliers Insert 
            <router-link to="/all-supplier" class="btn btn-sm btn-info " style="float:right;" id="add_new"> All Supplier</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="supplierInsert"  enctype="multipart/form-data">
                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-4 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.name">
					  <span class="text-danger text-center" v-if="errors.name">{{ errors.name[0] }}</span>
	                  <label for="firstName">Full Name</label>
	                </div>
	               </div>
	               <div class="col-md-4 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.email" >
					  <span class="text-danger text-center" v-if="errors.email">{{ errors.email[0] }}</span>
	                  <label for="lastName">Email Address</label>
	                </div>
	               </div>

				    <div class="col-md-4 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.phone" >
					  <span class="text-danger text-center" v-if="errors.phone">{{ errors.phone[0] }}</span>
	                  <label for="lastName">Phone Number</label>
	                </div>
	               </div>
	             </div>
	          </div>
	          <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.address" >
					  <span class="text-danger text-center" v-if="errors.address">{{ errors.address[0] }}</span>
	                  <label for="firstName">Address</label>
	                </div>
	               </div>
	               <div class="col-md-6 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.shopname">
					  <span class="text-danger text-center" v-if="errors.shopname">{{ errors.shopname[0] }}</span>
	                  <label for="lastName">Shop Name</label>
	                </div>
	               </div>
	             </div>
	          </div>
	              <div class="form-row">
	               <div class="col-md-6 mt-2">
	                <div class="form-label-group">
	                 <input type="file" class="form-control" @change="onFileSelected" >
					  <span class="text-danger text-center" v-if="errors.photo">{{ errors.photo[0] }}</span>
	                </div>
	               </div>
	                <div class="col-md-6 mt-2">
	                	<img :src="form.photo" style="height:80px; width: 80px;">
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
                 name:'',
                 email:'',
                 phone:'',
                 address:'',
                 shopname:'',
                 photo:'',
             },
              errors:{},
         }
        
     },
     methods:{
         onFileSelected(event){
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
        supplierInsert(){
            axios.post('/api/supplier/',this.form)
            .then(()=>{
                Notification.success()
                this.$router.push({ name: 'all-supplier'})
            })
            .catch(error => this.errors = error.response.data.errors)
        }
     }
 }
</script>

<style>
</style>