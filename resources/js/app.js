require("./bootstrap");

window.Vue = require("vue");

import VeeValidate from "vee-validate";

Vue.use(VeeValidate);

import store from "./store";

import VueI18n from "vue-i18n";

import messages from "./utils/messages";
Vue.use(VueI18n);

const i18n = new VueI18n({
  locale: localeLang, // set locale
  messages // set locale messages
});
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
  "profile-detail",
  require("./components/profile/profile.vue").default
);

const app = new Vue({
  el: "#app",
  store,
  i18n
});
