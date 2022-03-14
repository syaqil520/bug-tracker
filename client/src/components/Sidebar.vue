<template lang="">
    <div class="flex flex-col w-full h-screen px-4 py-8 bg-white ">
        <h2 class="text-3xl font-semibold text-gray-800 ">🕷 Bug Tracker</h2>
        
        <div class="flex flex-col justify-between flex-1 mt-6">
            <nav>
                <div class="sidebar-btn " @click="navigate(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>

                    <span class="mx-4 font-medium">Home</span>
                </div>

                <a class="sidebar-btn" @click="navigate(2)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="mx-4 font-medium">Project</span>
                </a>
                <div class="sidebar-btn" @click="navigate(3)">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 5V7M15 11V13M15 17V19M5 5C3.89543 5 3 5.89543 3 7V10C4.10457 10 5 10.8954 5 12C5 13.1046 4.10457 14 3 14V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V14C19.8954 14 19 13.1046 19 12C19 10.8954 19.8954 10 21 10V7C21 5.89543 20.1046 5 19 5H5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span class="mx-4 font-medium">Tickets</span>
                </div>



                <hr class="my-6 border-gray-200 dark:border-gray-600" />



                <div class="sidebar-btn hover:bg-red-500 hover:text-white" @click="logout" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="mx-4 font-medium">Logout</span>
                </div>
            </nav>

        </div>
    </div>
</template>
<script>
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

export default {
    setup() {
        const store = useStore()
        const router = useRouter()
        async function logout() {
            try {
                await store.dispatch('logout')
                router.push({ name: 'HomeGuest'})
            } catch (error) {
                console.log(error)
            }
        }

        function navigate(index) {
            if(index == 1) router.push({name: 'Home'})
            else if(index == 2) console.log('later')
            else if (index == 3) console.log('later also')

        }
        return {
            logout,
            navigate
        }
    }
}
</script>
<style lang="">
    
</style>