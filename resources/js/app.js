window.Vue = require('vue').default;

Vue.component('App', require('./App.vue').default);

const app = new Vue({
    el: '#app',
});
