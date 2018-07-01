import axios from 'axios'
import qs from 'qs'

//http request 拦截器
axios.interceptors.request.use(
    config => {
        let AccessToken = sessionStorage.getItem('user_info')
        if (!AccessToken) return config
        config.headers.access_token = AccessToken
        return config
    },
    error => {
        return Promise.reject(error)
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

function errorCB(res, reqInfo){
    if (!(res && (res.status === 200 || res.status === 304 || res.status === 400))) {
        console.error('接口出错:\n' + '【API】' + reqInfo.url + '\n【DATA】' + reqInfo.data);
    }
}

const http = (opts, data) => {
    //公共参数
    let Public = {}

    //默认配置
    let httpDefaultOpts = {
        method: opts.method,
        baseURL: '/dsmall',
        url: opts.url,
        timeout: 5000,
        params: Object.assign(Public, data),
        data: qs.stringify(Object.assign(Public, data)),
        headers: opts.method == 'get' 
        ? {
            'X-Requested-With': 'XMLHttpRequest',
            "Accept": "application/json",
            "Content-Type": "application/json; charset=UTF-8"
        }
        : {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        }
    }

    // 参数调整
    if (opts.method == 'get') {
        delete httpDefaultOpts.data
    } else {
        delete httpDefaultOpts.params
    }

    // 发送请求
    let promise = new Promise(function (resolve, reject) {
        axios(httpDefaultOpts)
        .then(
            (res) => {
                resolve(res)
            }
        ).catch(
            (res) => {
                errorCB(res, httpDefaultOpts)
                reject(res, httpDefaultOpts)
            }
        )
    })
    return promise
}

export {http, axios}