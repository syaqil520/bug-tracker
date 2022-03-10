import api from '@/api/authenticationApi.js'

const state = {
    user: null,
    authenticated: false
}

const getters = {
    user: state => state.user,
    authenticated: state => state.authenticated
}

const mutations = {
    SET_USER(state, payload) {
        state.user = payload
    },

    SET_AUTHENTICATED(state, payload) {
        state.authenticated = payload
    },

    RESET_AUTH(state) {
        state.user = null
        state.authenticated = false
    }
}

const actions = {
    async login({ commit }, payload) {
        await api.createSession()
        const { data } = await api.login(payload)
        if(data.success) {
            commit('SET_USER', data.user)
            commit('SET_AUTHENTICATED', true)
        }

        return data
    },

    async logout({ commit }) {
        const { data } = await api.logout()
        if(data.success) {
            commit('RESET_AUTH')
        }
    }

}

export default {
    state,
    getters,
    mutations,
    actions
}