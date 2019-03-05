<template>
  <div>
    <v-breadcrumbs :items="breadcrumbs" divider=">" style="margin-top: -20px;"></v-breadcrumbs>
    <v-tabs align-with-title class="elevation-0" color="cyan darken-1" dark>
      <v-tabs-slider color="white"/>
      <v-tab href="#detail">Info</v-tab>
      <v-tab href="#changePassword">{{ $t("message.changePassword") }}</v-tab>
      <v-tab-item :value="'detail'">
        <detail v-if="currentEdit"/>
      </v-tab-item>
      <v-tab-item :value="'changePassword'">
        <change-password></change-password>
      </v-tab-item>
    </v-tabs>
  </div>
</template>

<script>
import detail from "./detail";
import changePassword from "./changePassword";
import { global } from "../../mixins";
export default {
  components: { detail, changePassword },
  mixins: [global],
  props: ["user"],

  data() {
    return {
      breadcrumbs: [
        {
          text: "Dashboard",
          disabled: false,
          href: "/manage"
        },
        {
          text: "Profile",
          disabled: true,
          href: "/manage/profile"
        }
      ]
    };
  },
  mounted() {
    this.initStore();
  },
  methods: {
    initStore() {
      this.$store.commit("currentEdit", this.user);
    }
  }
};
</script>

<style scoped>
</style>
