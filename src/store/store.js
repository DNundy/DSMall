import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    // data
    state: {
        loginDivStatus: false,
        registerDivStatus: false,
        forgetDivStatus: false,
    },
    // computed
    getters: {

    },
    // methods 同步方法 -> commit
    mutations: {
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
        }
    },
    // methods 异步方法 -> dispatch
    actions: {

    }
})