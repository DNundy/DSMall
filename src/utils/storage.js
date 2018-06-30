import qs from 'qs'
const storageUtil = {
    setUserToken(data){
        localStorage.setItem('refresh_token', data.refresh_token);
        console.log('xxxx');
        
        sessionStorage.setItem('user_info', qs.stringify(data));
        console.log('yyyy');
        
    },
    clearUserToken(){
        localStorage.removeItem('refresh_token');
        sessionStorage.removeItem('user_info');
    }
};

export default storageUtil