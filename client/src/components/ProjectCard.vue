<template lang="">
    <div>
        <div class="card-white max-w-7xl  overflow-auto">
            <div class="flex justify-between mb-1">
                <p class="text-lg font-semibold tracking-widest">Project</p>
                <button class="btn-success py-1 " @click="openAddModal">New Project</button>
            </div>
            <project-list :projects="projectPagination"></project-list>

            <!-- pagination -->
             <div class="flex items-center justify-center ">
                <a href="#" class="flex items-center px-4 py-2 mx-1 text-gray-500 bg-white rounded-md border-2  " 
                    :class="projects.current_page === 1 ? 'cursor-not-allowed' : '' ">
                    previous
                </a>

                <div 
                    v-for="page in lastPage" :key="page">
                    <div 
                        class="items-center hidden px-4 py-2 mx-1 transition-colors duration-200 transform rounded-md sm:flex cursor-pointer"
                        :class="page === projects.current_page ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-blue-600 hover:text-white' "
                        @click="getProjectsPagination(page)" >
                        {{ page }}
                    </div>
                </div>


                <a href="#" class="flex items-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-200 transform bg-white rounded-md  hover:bg-blue-600 hover:text-white border-2 "
                    :class="projects.current_page === projects.last_page ? 'cursor-not-allowed' : '' ">
                    Next
                </a>
            </div>
        </div>

        <general-modal :show="showAddModal" @close="closeAddModal" >
            <div >
                <h2 class="modal-title">Add Project</h2>
                <form @submit.prevent="addProject">
                    <div>
                        <label class="text-gray-700 " for="name" >Project Name</label>
                        <input id="name" type="text" class="basic-input" v-model="tempProject.name" required>
                    </div>
                    <div>
                        <label class="text-gray-700 " for="description" >Project Description</label>
                        <input id="description" type="text" class="basic-input" v-model="tempProject.description" required>
                    </div>
                    <div class="text-right mt-3">
                        <button class="btn-primary" type="submit">Submit</button>
                    </div>

                </form>
            </div>
        </general-modal>
    </div>
</template>
<script>
import { onBeforeMount, reactive, ref, toRaw, computed } from 'vue'
import { useStore } from 'vuex'
import GeneralModalVue from './GeneralModal.vue'
import ProjectList from './ProjectListTable.vue'
import api from '@/api/projectApi'

export default {
    components: {
        'general-modal': GeneralModalVue,
        'project-list': ProjectList
    },
    setup() {
        const store = useStore()

        const projects = computed(() => store.getters['projects'])
        onBeforeMount(async () => {
            try {
                const data = await store.dispatch('getProjects')
            } catch (error) {
                console.log(error)
            }
        }) 

        const tempProject = reactive({
            name: '',
            description: ''
        })

        const showAddModal = ref(false)
        function openAddModal() {
            showAddModal.value = true
        }

        function closeAddModal() {
            showAddModal.value = false 
            tempProject.name = ''
            tempProject.description = ''
        }

        async function addProject() {
            try {
                const data  = await store.dispatch('addProject', toRaw(tempProject))
                if(data.success) {
                    closeAddModal()
                }
            } catch (error) {
                console.log(error)
            }
        }

        const projectPagination = computed(() => store.getters['projectPage'])
        const currentPage = computed(() => store.getters['currentPage'])
        const lastPage = computed(() => store.getters['lastPage'])

        function currentShowPage() {
            
        }

        async function getProjectsPagination(page) {
            const { data } = await api.getProjectPage(page)
            if(data.success) {
                store.commit('SET_PROJECTS', data.projects)
            }
        }

        return {
            projects,
            openAddModal,
            showAddModal,
            tempProject,
            addProject,
            closeAddModal,
            projectPagination,
            currentPage,
            lastPage,
            getProjectsPagination
        }
    }
}
</script>
<style lang="css">
    
</style>