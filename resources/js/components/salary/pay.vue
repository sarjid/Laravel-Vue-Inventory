<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Update-Employee</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
           Update Employee 
            <router-link to="/given-salary" class="btn btn-sm btn-info " style="float:right;" id="add_new"> All Employee</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="salaryPaid"  enctype="multipart/form-data">
					         
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
	                  <input type="text"  class="form-control" v-model="form.phone" >
					          <span class="text-danger text-center"  v-if="errors.phone">{{ errors.phone[0] }}</span>
	                  <label for="lastName">Phone Number</label>
	                </div>
	               </div>

                   <div class="col-md-4 mt-2">
	                <div class="form-label-group">
	                  <input type="text"  class="form-control" v-model="form.email" >
					          <span class="text-danger text-center"  v-if="errors.email">{{ errors.email[0] }}</span>
	                  <label for="lastName">Email Address</label>
	                </div>
	               </div>

	             </div>
	          </div>


              <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6">
	                  <div class="form-group">					   
                    <select class="form-control" id="exampleFormControlSelect1" v-model="form.salary_month">
                      <option value="January">January</option>
                      <option value="February">February</option>
                      <option value="March">March</option>
                      <option value="April">April</option>
                      <option value="May">May</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                      <option value="September">September</option>
                      <option value="October">October</option>
                      <option value="November">November</option>
                      <option value="Devember">December</option>
                    </select>
					    <span class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</span>
              <strong class="text-danger text-center" v-if="errors.employee_id">{{ errors.employee_id[0] }}</strong>
					  </div>
	               </div>
	               <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.salary" class="form-control"  required="">
	                  <label for="lastName">Salary</label>
	                  <span class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</span>
	                </div>
	               </div>
	             </div>
	          </div>
	
               <button type="submit" class="btn btn-danger mt-3">Pay Now</button>
              </form>
          </div>
         </div>
       </div>
   </div>
 
</template>

<script type="text/javascript" >
 export default { 
  created(){
    if (!User.loggedIn()) {
      this.$router.push({name : '/'})
    }
  },
  data(){
    return {
      form:{
        name: '',
        email: '',
        phone: '',
        salary: '',
        salary_month: '',
      },
      errors:{},
    }
  },
    created(){
        let id = this.$route.params.id
        axios.get('/api/employee/'+id)
        .then(({data}) =>(this.form = data))
        .catch(console.log('error'))
    },
	methods:{
		salaryPaid(){
      let id = this.$route.params.id
			axios.post('/api/salary/paid/'+id,this.form)
			.then(() =>{
				Notification.success()
				this.$router.push({ name: 'given-salary' })
				
			})
			.catch(error => this.errors = error.response.data.errors)
		}
    },
    

}
</script>

<style>
</style>