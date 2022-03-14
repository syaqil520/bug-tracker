import api from '@/api/ticketApi'

const state = {
    tickets: []

}

const getters = {
    tickets: state => state.tickets
}

const mutations = {
    SET_TICKETS(state, payload) {
        state.tickets = payload
    }
}

const actions = {
    async getTickets({ commit }, projectId) {
        const { data } = await api.getTickets(projectId)
        if(data.success) commit('SET_TICKETS', data.tickets)
    }
}
export default {
    state,
    getters,
    mutations,
    actions
}