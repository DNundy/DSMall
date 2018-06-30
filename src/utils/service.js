const service = {
    AccountLogin: {
        url: '/api/Account/login',
        method: 'post'
    },
    AccountRegister: {
        url: '/api/Account/register',
        method: 'post'
    },
    AccountRefresh: {
        url: '/api/AccountInfo/refresh',
        method: 'post'
    }
}

export default service