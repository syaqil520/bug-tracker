import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import Authentication  from './Authentication'
import Project from './Project'
export default createStore({
  plugins: [
    createPersistedState()
  ],
  state: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    Authentication,
    Project
  }
})
