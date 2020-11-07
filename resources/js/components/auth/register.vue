<template>
    <div>
       
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Register a New Account</div>
      <div class="card-body">
        <form @submit.prevent="signup">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputEmail" class="form-control" placeholder="Full Name"  autofocus="autofocus" v-model="form.name">
              <span class="text-danger text-center" v-if="errors.name"> {{ errors.name[0] }} </span>
              <label for="inputEmail">Full Name</label>
            </div>
          </div>
          <div class="form-group">
              <label for="inputEmail">Email address</label>
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus="autofocus" v-model="form.email">
              <span class="text-danger text-center" v-if="errors.email"> {{ errors.email[0] }} </span>
              
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password"  v-model="form.password">
              <span class="text-danger text-center" v-if="errors.password"> {{ errors.password[0] }} </span>
              <label for="inputPassword">Password</label>
            </div>
          </div>

           <div class="form-group">
              <label for="inputPassword">Confirm Password</label>
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Re-Type Password"  v-model="form.password_confirmation">
              <span class="text-danger text-center" v-if="errors.password_confirmation"> {{ errors.password_confirmation[0] }} </span>
            </div>
          </div>
         
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <div class="text-center">
          <router-link to="/" class="d-block small mt-3">Already Have An Account</router-link>

        </div>
      </div>
    </div>
  </div>
    </div>
</template>

<script type="text/javascript" >
 export default { 
  created(){
    if (User.loggedIn()) {
      this.$router.push({name : 'home'})
    }
  },
  data(){
    return {
      form:{
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      },
      errors:{},
    }
  },
  methods:{
    signup(){
      axios.post('/api/auth/signup',this.form)
      .then(res => { 
        User.responseAfterLogin(res)
        Toast.fire({
          type: 'success',
          title: 'Signed in successfully'
        })
        this.$router.push({ name : 'home'})
      })
      .catch(error => this.errors = error.response.data.errors)
    }
  }

}
</script>

<style>
</style>