<template lang="">
    <div class="container">
        <div class="card-white max-w-7xl  flex">
            <p class="text-blue-700 text-md font-semibold"> Welcome, {{ user.name }} 👋 </p>
            <span class="ml-2 font-semibold text-md text-gray-600">Your Dashboard</span>
        </div>

        <div class="mt-4 ">
            <project-card></project-card>
        </div>
    </div>
</template>
<script>
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import ProjectCardVue from '../components/ProjectCard.vue'

export default {
    components: {
        'project-card': ProjectCardVue
    },
    setup() {
        const store = useStore() 
        const user = store.getters['user']

        return {
            user
        }
    }
}
</script>
<style lang="">
    
</style>