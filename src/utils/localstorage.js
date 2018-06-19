import qs from 'qs'
const localstorage = {
    setUserToken(data){
        const auth = {
            "access_token": data.access_token,
            "refresh_token": data.refresh_token,
            "access_expires": Math.round(new Date() / 1000) + 3600,// 1小时
            "refresh_expires": Math.round(new Date() / 1000) + 604800,// 7天
        };
        localStorage.setItem('auth', qs.stringify(auth));
    },
};

export default localstorage