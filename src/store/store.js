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

        // 账户信息
        userInfo: {
            a_id: '',
            a_name: '',
            a_email: '',
            a_auth: '',
            access_token: '',
            refresh_token: ''
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
        addAccessToken(state, value) {
            state.userInfo.access_token = value;
        },
        addRefreshToken(state, value) {
            state.userInfo.refresh_token = value;
        }
    },
    // methods 异步方法 -> dispatch
    actions: {

    }
})