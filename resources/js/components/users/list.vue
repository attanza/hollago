<template>
  <div>
    <v-breadcrumbs :items="breadcrumbs" divider=">" style="margin-top: -20px;"></v-breadcrumbs>
  </div>
</template>
<script>
import { USERS_URL } from "../../utils/apis.js";
import catchError from "../../utils/catchError.js";
import { global } from "../../mixins";
export default {
  mixins: [global],
  props: ["canCreate"],
  data() {
    return {
      breadcrumbs: [
        {
          text: "Dashboard",
          disabled: false,
          href: "/manage"
        },
        {
          text: "Users",
          disabled: true,
          href: "/manage/users"
        }
      ],
      items: [],
      headers: ["name", "email", "phone", "role"]
    };
  },
  mounted() {
    this.populateTable();
  },
  methods: {
    async populateTable() {
      try {
        const endPoint = `${USERS_URL}?${this.getQueryParams()}`;
        const resp = await axios.get(endPoint);
        console.log("resp", resp);
        if (resp.status === 200) {
          this.items = resp.data.data;
        }
      } catch (e) {
        catchError(e);
      }
    },
    getRoles(roles) {
      let role = "";
      roles.map(r => (role += r.name + " "));
      return role;
    }
  }
};
</script>
