import Token from './Token'
import AppStorage from './AppStorage'

class User{
    
    responseAfterLogin(res){
        const access_token = res.data.access_token
        const username = res.data.name
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token,username)
        }
    }

    // jodi token thake 
    hasToken(){
        const storeToken = localStorage.getItem('token')
        if (storeToken) {
            return Token.isValid(storeToken) ? true : false
        }
        return false
    }

    // when use loggedin 
    loggedIn(){
        return this.hasToken()
    }

    // this logout not use , because this syestem take page reload to logout 
    logout(){
        AppStorage.clear()
        this.$router.push({ name: '/'})

    }

    name(){
        if (this.loggedIn()) {
            return localStorage.getItem('user')
        }
    }

    id(){
        if (this.loggedIn) {
            const payload = Token.payload(localStorage.getItem('token'))
            return payload.sub
        }
    }

}

export default User = new User();