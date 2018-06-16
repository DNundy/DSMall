import Vue from 'vue'
import Router from 'vue-router'
import indexRouter from './index'
import adminRouter from './admin'

Vue.use(Router)

export default new Router({
    routes: [
        ...indexRouter,
        ...adminRouter
    ]
})
