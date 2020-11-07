class AppStorage{
    // store token 
    storeToken(token){
        localStorage.setItem('token',token)
    }
    // store user 
    storeUser(user){
        localStorage.setItem('user',user)
    }
    // store user and token 
    store(token,user){
        this.storeToken(token)
        this.storeUser(user)
    }
    // clear user and token 
    clear(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
    }
    // get token 
    getToken(){
        localStorage.getItem('token')
    }

     // get user 
     getUser(){
        localStorage.getItem('user')
    }


}

export default  AppStorage = new AppStorage();