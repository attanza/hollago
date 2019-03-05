import changeCase from "change-case";
import { mapState } from "vuex";
import Tbtn from "../components/Tbtn";
import Dialog from "../components/Dialog";
export default {
  components: { Tbtn, Dialog },
  data() {
    return {
      pagination: {
        page: 1,
        per_page: 10,
        search: null,
        search_by: null,
        search_query: null,
        between_date: null,
        start_date: null,
        end_date: null,
        sort_by: null,
        sort_mode: null
      },
      shows: [10, 25, 50, 100],
      showDialog: false
    };
  },
  computed: {
    ...mapState(["currentEdit"])
  },
  methods: {
    inArray(keys, searchedKey) {
      let result = false;
      for (let i in keys) {
        if (keys[i] === searchedKey) {
          result = true;
        }
      }
      return result;
    },
    setCase(txt) {
      return changeCase.titleCase(txt);
    },
    getQueryParams() {
      let query = "";
      for (let key in this.pagination) {
        if (
          this.pagination.hasOwnProperty(key) &&
          this.pagination[key] != null
        ) {
          query += `${key}=${this.pagination[key]}&`;
        }
      }
      return query;
    }
  }
};
