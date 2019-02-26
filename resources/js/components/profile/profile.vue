<template>
  <div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a
          class="nav-link active"
          id="home-tab"
          data-toggle="tab"
          href="#home"
          role="tab"
          aria-controls="home"
          aria-selected="true"
        >Detail</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          id="profile-tab"
          data-toggle="tab"
          href="#profile"
          role="tab"
          aria-controls="profile"
          aria-selected="false"
        >Change Password</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <detail v-if="currentEdit"/>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <change-password></change-password>
      </div>
    </div>
  </div>
</template>
<script>
import detail from "./detail";
import changePassword from "./changePassword";
import { global } from "../../mixins";
export default {
  components: { detail, changePassword },
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
