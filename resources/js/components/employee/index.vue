<template>
     
   <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employee</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Employee List
            <router-link to="/add-employee" class="btn btn-sm btn-info " style="float:right;" id="add_new"> Add New</router-link>
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
                    <th>Sallery</th>
                    <th>Joining Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="employee in filtersearch" :key="employee.id">
                    <td>{{ employee.name }}</td>
                    <td>
                      <img :src="employee.photo" id="photo_size" alt="">
                    </td>
                    <td>{{ employee.phone }}</td>
                    <td>{{ employee.salary }}</td>
                    <td>{{ employee.joining_date }}</td>
                    <td>
                      <router-link :to="{ name:'edit-employee', params:{ id: employee.id }}" class="btn btn-sm btn-info">Edit</router-link>
                      <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger">Delete</a>
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
        this.allEmployee();
        },

        data(){
          return{
            employees:[],
            searchTerm:'',         
          }
        },
       computed:{
         filtersearch(){
          return this.employees.filter(employee => {
             return employee.phone.match(this.searchTerm)
           })
         }
       },
        methods:{
          allEmployee(){
            axios.get('/api/employee/')
            .then(({data}) => (this.employees = data))
            .catch()
          },

          deleteEmployee(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
             icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
          })
            .then((result) => {
              if (result.value) {
                axios.delete('/api/employee/'+id)
                .then(()=>{
                  this.employees = this.employees.filter(employee =>{
                    return employee.id !=id
                  })
                })
                .catch(()=>{
                  this.$router.push({ name: 'employee' })
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