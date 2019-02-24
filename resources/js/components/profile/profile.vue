<template>
  <v-tabs align-with-title color="white">
    <v-tabs-slider color="white"/>
    <v-tab href="#detail">Detail</v-tab>
    <v-tab-item
      :value="'detail'"
    >Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis odio enim non soluta commodi rem veritatis quo, culpa ad ea dolorum saepe minus iste, sit veniam minima officiis voluptates ratione!</v-tab-item>
  </v-tabs>
</template>
<script>
export default {
  data() {
    return {
      active: null,
      text:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
    };
  },
  methods: {
    next() {
      const active = parseInt(this.active);
      this.active = active < 2 ? active + 1 : 0;
    }
  }
};
</script>
