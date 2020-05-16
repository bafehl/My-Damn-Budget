import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from '../assets/js/views/App'
import Hello from '../assets/js/views/Hello'
import Home from '../assets/js/views/Home'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
