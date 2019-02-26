import changeCase from "change-case";
import { mapState } from "vuex";
export default {
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
    }
  }
};
