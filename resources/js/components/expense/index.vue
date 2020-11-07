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
            Expense List
            <router-link to="/add-expense" class="btn btn-sm btn-info " style="float:right;" id="add_new">Add New</router-link>
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
              <input type="search" v-model="searchTerm" class="form-control" placeholder="search by date" id="search"> <br>
              <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Expense Details</th>
                    <th>Expense Amount</th>
                    <th>Expense Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
             
                <tbody>
                  <tr v-for="(expense,index) in filterSearch" :key="expense.id" >
                    <td>{{ index+1 }}</td>
                    <td>{{ expense.details }}</td>
                    <td>{{ expense.amount }}</td>
                    <td>{{ expense.date }}</td>
                    <td>
                      <router-link :to="{ name:'edit-expense',params:{ id:expense.id }}"  class="btn btn-sm btn-info">Edit</router-link>
                      <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger">Delete</a>
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
            this.$router.push({ name:'/' })
        }
    },
    created(){
        this.allExpense()
    },

    data(){
        return{
            expenses:[],
            searchTerm:''
        }
    },

    computed:{
        filterSearch(){
            return this.expenses.filter(expense=>{
                return expense.date.match(this.searchTerm)
            })
        }
    },

    methods:{
        allExpense(){
            axios.get('/api/expense')
            .then(({data}) =>{this.expenses = data})
            .catch(console.log('error'))
        },

        deleteExpense(id){
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
               axios.delete('/api/expense/'+id)
               .then(()=>{
                    this.expenses = this.expenses.filter(expense=>{
                       return expense.id !=id
                   })

                    Swal.fire(
                    'Deleted!',
                    'Your data has been deleted.',
                    'success'
                    )
               })
               .catch(()=>{
                   this.$router.push({ name:'all-expense' })
                     Swal.fire(
                    'Opps..!',
                    'Your file Not Deleted.',
                    'warning'
                    )
               })
               
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