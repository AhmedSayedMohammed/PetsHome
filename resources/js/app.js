

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

let fs = require('fs');


Vue.component('follow', require('./components/Follow.vue').default);
Vue.component('posts', require('./components/Posts.vue').default);
Vue.component('consultation', require('./components/Consultation.vue').default);
Vue.component('InfiniteLoading', require('vue-infinite-loading'));




import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);



const router = new VueRouter({ mode: 'history'});
const app = new Vue(Vue.util.extend({ router })).$mount('#app');