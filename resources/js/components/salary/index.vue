<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Salary List</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Salary List

          </div>
          
          <div class="card-body">
            <div class="table-responsive">
            
              <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Month Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="salary in salaries" :key="salary.salary_month">
                    <td>{{ salary.salary_month }}</td>
                    <td>
                      <router-link :to="{ name:'view-salary', params:{ id: salary.salary_month }}" class="btn btn-info">View </router-link>
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
 export default { 
  	mounted(){
            if (!User.loggedIn()) {
               this.$router.push({ name:'/' })
            }
        },

        created(){
        this.allSalaries();
        },

        data(){
          return{
            salaries:[],        
          }
        },
       
        methods:{
          allSalaries(){
            axios.get('/api/salary/')
            .then(({data}) => (this.salaries = data))
            .catch()
          },
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