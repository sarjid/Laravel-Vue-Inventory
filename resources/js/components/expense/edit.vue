<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Expense</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
           Update Expense
            <router-link to="/all-expense" class="btn btn-sm btn-info" id="add_new">All Expense</router-link>
          </div>
          <form @submit.prevent="expenseUdpate">
            <div class="card-body">
                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-12">
	               	<div class="form-group">
				       <label for="exampleFormControlTextarea1">Details Of Expense</label>
				       <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="form.details"></textarea>
				       <span class="text-danger" v-if="errors.details">{{ errors.details[0] }}</span>
				     </div>
	               </div>
	               <div class="col-lg-12">
	               	<div class="form-label-group">
	                  <input type="text" v-model="form.amount" class="form-control" >
	                  <span class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</span>
	                  <label for="firstName">Expense Amount</label>
	                </div>
	               </div>
	             </div>
	            </div>     
	          </div>
              <button type="submit" class="btn btn-success">Update Expense</button>
            </form>
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
                 details:'',             
                 amount:'',             
             },
              errors:{},
         }
        
     },
      created(){
         let id = this.$route.params.id
         axios.get('/api/expense/'+id)
         .then(({data}) => (this.form = data))
         .catch(console.log('error'))
     },
     methods:{        
         expenseUdpate(){
           let id = this.$route.params.id
          axios.patch('/api/expense/'+id,this.form)
          .then(()=>{
              Notification.update();
              this.$router.push({ name: 'all-expense'})
          })
          .catch(error => this.errors = error.response.data.errors)
        }
     }
 }
</script>

<style>
#add_new{
  float: right;
}
</style>