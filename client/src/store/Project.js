import api from '@/api/projectApi'

const state = {
    projects: [],
    project: null,

}

const getters = {
    projects: state => state.projects,
    project: state => state.project,
    projectPage: state => state.projects.data,
    currentPage: state => state.projects.current_page,
    lastPage: state => state.projects.last_page
}

const mutations = {
    SET_PROJECTS(state, payload) {
        state.projects = payload
    },

    SET_PROJECT(state, payload) {
        state.project = payload
    },

    APPEND_PROJECTS(state, payload) {
        state.projects.push(payload)
    },

    DELETE_PROJECT() {

    },


}

const actions = {
    async getProjects({ commit }) {
        const { data } = await api.getProjects()
        if(data.success) {
            commit('SET_PROJECTS', data.projects)
        }  

        return data
    },

    async addProject({ commit }, payload) {
        const { data } = await api.storeProject(payload)
        if(data.success) {
            commit('APPEND_PROJECTS', data.project)
        }
        return data
    },

    async getProject({ commit }, payload) {
        
        const { data } = await api.getProject(payload)
        if(data.success) {
            commit('SET_PROJECT', data.project)
        }
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}