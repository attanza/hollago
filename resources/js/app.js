require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify'

Vue.use(Vuetify)

import 'vuetify/dist/vuetify.min.css'
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('profile-detail', require('./components/profile/profile.vue').default);

const app = new Vue({
    el: '#app'
});
