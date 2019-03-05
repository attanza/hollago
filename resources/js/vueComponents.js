import Vue from "vue";

/**
 * Profile
 */
Vue.component(
  "profile-detail",
  require("./components/profile/profile.vue").default
);
/**
 * Users
 */
Vue.component("user-list", require("./components/users/list.vue").default);
Vue.component("user-detail", require("./components/users/detail.vue").default);
Vue.component("user-login", require("./components/Login.vue").default);
