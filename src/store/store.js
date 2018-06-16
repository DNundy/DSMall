import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        
    },
    // 类似 vue 里的 mothods(同步方法)
    mutations: {
        updateName(state) {
            state.name = 'newName'
        }
    }
})