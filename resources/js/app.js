require('./bootstrap');

window.Vue = require('vue').default;

// Vue.component('side-nav', require('./components/SideNav.vue').default);
Vue.component('footer-el', require('./components/Footer.vue').default);

const app = new Vue({
    el: '#app',
});
