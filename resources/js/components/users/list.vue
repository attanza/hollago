<template>
  <div>
    <v-breadcrumbs :items="breadcrumbs" divider=">" style="margin-top: -20px;"></v-breadcrumbs>
    <v-card class="pt-3 elevation-0">
      <v-toolbar card color="transparent">
        <Tbtn
          v-if="canCreate"
          :bottom="true"
          :tooltip-text="$t('message.add')"
          icon-mode
          color="primary"
          icon="add"
          @onClick="showForm = true"
        />
        <v-spacer/>
        <v-text-field
          v-model="pagination.search"
          append-icon="search"
          :label="$t('message.search')"
          single-line
          hide-details
        />
      </v-toolbar>
      <v-data-table
        :headers="headers"
        :items="items"
        :loading="loading"
        :pagination.sync="pagination"
        :total-items="totalItems"
        :rows-per-page-items="rowsPerPage"
        class="elevation-0"
      >
        <template slot="items" slot-scope="props">
          <td>
            <a @click="toDetail(props.item)">{{ props.item.name }}</a>
          </td>
          <td>{{ props.item.email }}</td>
          <td>{{ props.item.phone }}</td>
          <td>{{ props.item.roles ? getRoles(props.item.roles) : '' }}</td>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>
<script>
import debounce from "lodash/debounce";
import { USERS_URL } from "../../utils/apis";
import { global } from "../../mixins";
import catchError from "../../utils/catchError";

export default {
  mixins: [global],
  data: () => ({
    title: "User",
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
    tableHeader: ["name", "email", "phone", "roles"],
    headers: [],
    items: []
  }),
  props: ["canCreate"],
  watch: {
    pagination: {
      handler: debounce(function() {
        this.pupulateTable();
      }, 500),
      deep: true
    }
  },

  mounted() {
    this.pupulateTable();
    this.setHeaders();
  },

  methods: {
    setHeaders() {
      this.tableHeader.map(h => {
        this.headers.push({
          text: this.$t(`message.${h}`),
          align: "left",
          value: h,
          sortable: h === "roles" ? false : true
        });
      });
    },
    async pupulateTable() {
      try {
        // this.activateLoader();
        this.loading = true;

        const { descending, sortBy } = this.pagination;
        const endPoint = `${USERS_URL}?${this.getQueryParams()}`;
        console.log("endPoint", endPoint);
        const res = await axios.get(endPoint).then(res => res.data);
        console.log("res", res);
        this.items = res.data;
        this.totalItems = res.total;
        if (this.pagination.sortBy) {
          this.items = this.items.sort((a, b) => {
            const sortA = a[sortBy];
            const sortB = b[sortBy];

            if (descending) {
              if (sortA < sortB) return 1;
              if (sortA > sortB) return -1;
              return 0;
            } else {
              if (sortA < sortB) return -1;
              if (sortA > sortB) return 1;
              return 0;
            }
          });
        }
        this.loading = false;
        // this.deactivateLoader();
      } catch (e) {
        console.log("e", e);
        this.loading = false;
        // this.deactivateLoader();
        catchError(e);
      }
    },
    toDetail(data) {
      this.$router.push(`/users/${data.id}`);
    },
    addData(data) {
      this.items.unshift(data);
      this.showForm = false;
    },
    getRoles(roles) {
      let role = "";
      roles.map(r => (role += r.name + " "));
      return role;
    }
  }
};
</script>
