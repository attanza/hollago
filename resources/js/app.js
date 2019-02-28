require("./bootstrap");

window.Vue = require("vue");

import Vuetify from "vuetify";

Vue.use(Vuetify);

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

require("./vueComponents");

const app = new Vue({
  el: "#app",
  store,
  i18n,
  data: () => ({
    drawer: null
  }),
  methods: {
    logout() {
      axios
        .post("/logout")
        .then(() => {
          window.location.replace("/login");
        })
        .catch(e => console.log(e));
    }
  }
});
