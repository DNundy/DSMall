import qs from 'qs'
const storageUtil = {
    setUserInfo(data){
        localStorage.setItem('refresh_token', data.refresh_token);
        sessionStorage.setItem('user_info', qs.stringify(data));
    },
    clearUserInfo(){
        localStorage.removeItem('refresh_token');
        sessionStorage.removeItem('user_info');
    }
};

export default storageUtil