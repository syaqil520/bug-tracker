import axios from 'axios'
import store from '../store'
let instance = axios.create({
    baseURL: 'http://localhost:8000',
    withCredentials: true
})

instance.interceptors.request.use( request => {
    request.headers.common['Accept'] = 'application/json'
    request.headers.common['content-type'] = 'application/json' 
    return request
})

instance.interceptors.response.use( 
    response => response,
    error => {
        if(error.response.status === 401) {
            store.commit('RESET_AUTH')
            console.log('cookies expired')
            window.location.reload()
        }
        return Promise.reject(error)
    }
)

export default instance
    

