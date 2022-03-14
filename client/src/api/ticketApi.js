import api from './config'

export default {
    async storeTicket(projectId, payload) {
        return api.post(`/api/project/${projectId}/ticket`, payload)
    },

    async getTickets(projectId) {
        return api.get(`api/project/${projectId}/ticket`)
    }
}