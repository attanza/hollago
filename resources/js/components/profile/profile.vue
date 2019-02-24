<template>
  <v-tabs align-with-title color="white">
    <v-tabs-slider color="white"/>
    <v-tab href="#detail">Detail</v-tab>
    <v-tab-item :value="'detail'">
      <detail v-if="currentEdit"/>
    </v-tab-item>
  </v-tabs>
</template>
<script>
import detail from "./detail";
import { global } from "../../mixins";
export default {
  components: { detail },
  mixins: [global],
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  mounted() {
    this.initStore();
  },
  methods: {
    initStore() {
      if (this.user) {
        this.$store.commit("currentEdit", this.user);
      }
    }
  }
};
</script>
