<template>
 <div>     
    <div class="container">
        <!-- Breadcrumbs-->
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Home</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">{{ todaysell }} tk</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Today Sell</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">{{ todayincome }} Tk</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Today Income</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    </div>
                    <div class="mr-5">{{ todaydue }} tk</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Today Due</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                    </div>
                    <div class="mr-5">{{ todayexpense }} tk</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Today Expense</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
                </div>
            </div>

                <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">{{ totalcustomer }}</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Total Customers</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
                </div>
            </div>

            
                <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">{{ totalemployee }}</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Total Employee</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
                </div>
            </div>

                    <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">{{ totalproduct }}</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Total Product</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
                </div>
            </div>

                <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">{{ stockoutproduct }}</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Stock Out Products</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
                </div>
            </div>


            </div>
    </div>
 </div>
</template>

<script type="text/javascript" >

export default{
    // if user not login , he don't access in home page 
  mounted(){
    if (!User.loggedIn()) {
      this.$router.push({ name: '/' })
    }

    
  },

  data(){
      return{
          todaysell:'',
          todayincome:'',
          todaydue:'',
          todayexpense:'',
          totalcustomer:'',
          totalemployee:'',
          totalproduct:'',
          stockoutproduct:'',
      }
  },
  created(){
      this.todaySell();
      this.todayIncome();
      this.todayDue();
      this.todayExpense();
      this.totalCustomers();
      this.totalEmployee();
      this.totalProducts();
      this.stockoutProducts();
  },

  methods:{
      todaySell(){
          axios.get('/api/today/sell')
          .then(({data}) => (this.todaysell = data))
          .catch()
      },
      todayIncome(){
          axios.get('/api/today/income')
          .then(({data}) => (this.todayincome = data))
          .catch()
      },
       todayDue(){
          axios.get('/api/today/due')
          .then(({data}) => (this.todaydue = data))
          .catch()
      },
      todayExpense(){
          axios.get('/api/today/expense')
          .then(({data}) => (this.todayexpense = data))
          .catch()
      },
       totalCustomers(){
          axios.get('/api/total/customer')
          .then(({data}) => (this.totalcustomer = data))
          .catch()
      },
       totalEmployee(){
          axios.get('/api/total/employee')
          .then(({data}) => (this.totalemployee = data))
          .catch()
      },
       totalProducts(){
          axios.get('/api/total/product')
          .then(({data}) => (this.totalproduct = data))
          .catch()
      },
       stockoutProducts(){
          axios.get('/api/total/stockout/product')
          .then(({data}) => (this.stockoutproduct = data))
          .catch()
      },
      
  }

}
</script>

<style>
</style>