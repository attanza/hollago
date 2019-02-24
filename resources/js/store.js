import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    currentEdit: null
  },
  mutations: {
    currentEdit(state, v) {
      state.currentEdit = v
    }
  }
})
