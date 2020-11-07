<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">view salary</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Salary Details
          
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
             <input type="search" v-model="searchTerm" class="form-control" placeholder="search employee name" id="search"> <br>
              <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Employee Name</th>
                    <th>Photo</th>
                    <th>Salary Month</th>
                    <th>Salary Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="salary in filterSearch" :key="salary.id">
                    <td>{{ salary.employee.name }}</td>
                    <td>
                      <img :src="'/'+salary.employee.photo" id="photo_size" alt="">
                    </td>
                    <td>{{ salary.salary_month }}</td>
                    <td>{{ salary.salary_date }}</td>
                    <td>{{ salary.amount }}</td>
                    <td>
                      <router-link :to="{ name:'edit-salary', params:{ id: salary.id }}" class="btn btn-sm btn-info">Edit </router-link>
                      <a class="btn btn-sm btn-danger">Delete</a>

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
        this.viewSalary();
        },

        data(){
          return{
            salaries:[],  
            searchTerm:'',      
          }
        },
       computed:{
         filterSearch(){
           return this.salaries.filter(salary=>{
             return salary.salary_month.match(this.searchTerm)
           })
         }
       },
        methods:{
          viewSalary(){
              let id = this.$route.params.id
            axios.get('/api/salary/view/'+id)
            .then(({data}) => (this.salaries = data))
            .catch()
          },

        //   deleteEmployee(id){
        //     Swal.fire({
        //     title: 'Are you sure?',
        //     text: "You won't be able to revert this!",
        //      icon: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Delete'
        //   })
        //     .then((result) => {
        //       if (result.value) {
        //         axios.delete('/api/salary/'+id)
        //         .then(()=>{
        //           this.salaries = this.salaries.filter(salary =>{
        //             return salary.id !=id
        //           })
        //         })
        //         .catch(()=>{
        //           this.$router.push({ name: 'salary' })
        //         })
        //         Swal.fire(
        //           'Deleted!',
        //           'Your file has been deleted.',
        //           'success'
        //         )
        //       }
        //     })
        // }
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