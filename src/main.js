import Vue from 'vue'
import App from './App'
import router from './router'
import axios from 'axios'
axios.defaults.baseURL = '/dsmall'
Vue.prototype.$ajax = axios

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
