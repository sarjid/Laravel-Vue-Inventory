class Token{

    // token validity check
    isValid(token){
        const payload = this.payload(token);
        if (payload) {
            return payload.iss == "http://127.0.0.1:8000/api/auth/login" || "http://127.0.0.1:8000/api/auth/register" ? true : false
        }
        return false
    }

    // payload token 3 parts but we get one part okay 
    payload(token){
        const payload = token.split('.')[1]
        return this.decode(payload)
    }

    decode(payload){
        return JSON.parse(atob(payload))
    }


}

export default Token = new Token();