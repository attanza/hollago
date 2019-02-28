<template>
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">
          <button class="btn btn-success">add</button>
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control">
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover sortable">
          <thead>
            <tr>
              <th v-for="(h, index) in headers" :key="index">{{ $t(`message.${h}`) }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item.id">
              <td>
                <a :href="`/manage/users/${item.uuid}`">{{ item.name}}</a>
              </td>
              <td>{{ item.email }}</td>
              <td>{{ item.phone }}</td>
              <td>{{ item.roles ? getRoles(item.roles): '' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
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
