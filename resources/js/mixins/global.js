import changeCase from "change-case"
import Tbtn from "../components/Tbtn"
import {
  mapState
} from 'vuex'
export default {
  components: {
    Tbtn
  },
  computed: {
    ...mapState([
      "currentEdit"
    ])
  },
  methods: {
    inArray(keys, searchedKey) {
      let result = false
      for (let i in keys) {
        if (keys[i] === searchedKey) {
          result = true
        }
      }
      return result
    },
    setCase(txt) {
      return changeCase.titleCase(txt)
    }
  },
}
