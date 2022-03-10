<template>
    <div class="grid grid-cols-6 ">
        <div class="col-span-1 w-full" v-if="authenticated">
            <side-bar></side-bar>

        </div>
        <div class="col-span-5 px-6 py-6">
            <router-view/>

        </div>
        
    </div>
</template>

<script>
import { useStore } from 'vuex'
import { computed } from 'vue'
import SidebarVue from './components/Sidebar.vue'

export default {
    components: {
        'side-bar': SidebarVue
    },
    setup() {
        const store = useStore()

        const authenticated = computed(() => store.getters['authenticated'])

        return {
            authenticated
        }
    }
}
</script>


<style>

</style>
