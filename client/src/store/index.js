import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import Authentication  from './Authentication'
import Project from './Project'
import Ticket from './Ticket'
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
    Project,
    Ticket
  }
})
