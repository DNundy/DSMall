import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        // 账户体系面板状态
        accountStatus: {
            loginDiv: false,
            registerDiv: false,
            forgetDiv: false,
            loginStatus: false,
        },

        // 账户信息
        userInfo: {}
    },
    mutations: {
        // 账户面板状态更改
        accountPanel(state, data){
            state.accountStatus[data.name] = data.status;
        },
        
        // 登录账户
        setUserInfo(state, data) {
            for (var key in data) {
                if (data.hasOwnProperty(key) === true) {
                    state.userInfo[key] = data[key];
                }
            }
            state.accountStatus.loginStatus = true;
        },

        // 退出登录
        clearUserInfo(state){
            state.userInfo={};
            state.accountStatus.loginStatus = false;
        },
    },
    actions: {

    },
    getters: {

    },
})