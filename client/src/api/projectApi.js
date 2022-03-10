import api from './config'

export default {
    async getProjects() {
        return api.get(`/api/project`)
    },

    async getProject(projectId) {
        return api.get(`/api/project/${projectId}`)
    },

    async storeProject(payload) {
        return api.post(`/api/project`, payload)
    },

    async deleteProject(projectId) {
        return api.delete(`/api/project/${projectId}`)
    },

    async getProjectPage(page) {
        return api.get(`/api/project?page=${page}`)
    } 
}