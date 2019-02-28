<template>
  <div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a
          class="nav-link active"
          id="detail-tab"
          data-toggle="tab"
          href="#detail"
          role="tab"
          aria-controls="detail-tab"
          aria-selected="true"
        >Detail</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div
        class="tab-pane fade show active"
        id="detail"
        role="tabpanel"
        aria-labelledby="detail-tab"
      >
        <dform v-if="currentEdit" :can-update="canUpdate"/>
      </div>
    </div>
  </div>
</template>
<script>
import dform from "./dform";
import { global } from "../../mixins";
export default {
  components: { dform },
  mixins: [global],
  props: ["user", "canUpdate"],
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
