import axios from 'axios';
import qs from 'qs';

axios.defaults.timeout = 5000;
axios.defaults.baseURL = '/dsmall'

//http request 拦截器
axios.interceptors.request.use(
    config => {
        let auth = localStorage.getItem('auth');
        config.headers = {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
        if (!auth) return config;

        auth = qs.parse(auth);
        config.headers.access_token = auth.access_token;
        config.headers.refresh_token = auth.refresh_token;
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