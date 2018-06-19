import axios from 'axios';

axios.defaults.timeout = 5000;
axios.defaults.baseURL = '/dsmall'

//http request 拦截器
axios.interceptors.request.use(
    config => {
        const access_token = localStorage.getItem('access_token')
        const refresh_token = localStorage.getItem('refresh_token')
        config.headers = {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
        if (access_token && refresh_token) {
            config.headers.access_token = access_token;
            config.headers.refresh_token = refresh_token;
        }
        return config
    },
    error => {
        return Promise.reject(err)
    }
);


//http response 拦截器
axios.interceptors.response.use(
    response => {
        return response
    },
    error => {
        return Promise.reject(error)
    }
)

export default axios