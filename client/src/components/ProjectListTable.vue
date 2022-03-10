<template lang="">
    <div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left
                             text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Project Name
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left
                             text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Project Description
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left 
                            text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Contributor
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right
                             text-xs font-semibold text-gray-700 uppercase tracking-wider ">
                            </th>                                
                        </tr>
                    </thead>
                    <tbody >
                        <tr v-for="(project, index) in projects" :key="index" >
                            <td 
                                class="px-5 py-5 border-b border-gray-200 bg-white text-md cursor-pointer text-gray-900 hover:text-blue-700  hover:font-bold hover:underline-offset-1 hover:underline font-semibold"
                                @click="pushProject(project.id)" >
                                
                                <span class=" whitespace-no-wrap ml-5 ">{{ project.name }}</span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-md ">
                                <span class="text-gray-900 whitespace-no-wrap ml-5">{{ project.description }}</span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-md ">
                                <span class="text-gray-900 whitespace-no-wrap ml-5 block" v-for="(user, index) in project.users" :key="index">{{ user.name }} </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                <button
                                type="button"
                                class="inline-block text-gray-500 hover:text-gray-700"
                                >
                                <svg
                                    class="inline-block h-6 w-6 fill-current"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                    d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z"
                                    />
                                </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</template>
<script>
import { useRouter } from 'vue-router'
export default {
    props:['projects'],
    setup() {
        const router = useRouter()
        
        function pushProject(projectId) {
            router.push({ name: 'ProjectDashboard', params: { id: projectId}})
        }
        
        return {
            pushProject
        }
    }
    
}
</script>
<style lang="">
    
</style>