import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    // data
    state: {
        // 全局账户体系面板状态
        loginDivStatus: false,
        registerDivStatus: false,
        forgetDivStatus: false,

        login_status: false,

        // 账户信息
        userInfo: {
            // 基本信息
            a_id: '',
            a_name: '',
            a_email: '',
            a_auth: '',

            // Token
            access_token: '',
            refresh_token: '',
        }
    },
    // computed
    getters: {

    },
    // methods 同步方法 -> commit
    mutations: {
        // 账户状态设置
        openLoginDiv(state){
            state.loginDivStatus = true;
        },
        closeLoginDiv(state) {
            state.loginDivStatus = false;
        },
        openRegisterDiv(state) {
            state.registerDivStatus = true;
        },
        closeRegisterDiv(state) {
            state.registerDivStatus = false;
        },
        openForgetDiv(state) {
            state.forgetDivStatus = true;
        },
        closeForgetDiv(state) {
            state.forgetDivStatus = false;
        },

        // 全局账户信息
        setUserInfo(state, data) {
            for (var key in data) {
                if (data.hasOwnProperty(key) === true) {
                    state.userInfo[key] = data[key];
                }
            }
            // state.userInfo.access_expires = Math.round(new Date() / 1000) + 3600;
            // state.userInfo.refresh_expires = Math.round(new Date() / 1000) + 604800;
        },

        // 登录状态
        changeLoginStatus(state, value){
            state.login_status = value;
        },
    },
    // methods 异步方法 -> dispatch
    actions: {

    }
})