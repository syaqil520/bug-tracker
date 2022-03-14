<template lang="">
    <div class="">
        <div class="card-white  flex">
            <p class="text-blue-700 text-lg font-semibold"> Your Dashboard 📊 </p>
            <span class="ml-2 font-semibold text-lg text-gray-900 tracking-wide"> {{ project.name}} </span>
        </div>

        <div class="grid grid-cols-3 gap-4 mt-4 ">

            <div class="col-span-3 card-white w-full ">
                <ticket-card></ticket-card>
            </div>

            <!-- <div class="col-span-1 card-white w-full"> -->

            <!-- </div> -->

        </div>
    </div>
</template>
<script>
import { onBeforeMount } from '@vue/runtime-core'
import { useRoute } from 'vue-router'
import { useStore } from 'vuex'
import { computed } from 'vue'
import TicketCard from '@/components/TicketCard.vue'

export default {
    components: {
        'ticket-card': TicketCard
    },
    setup() {

        const route = useRoute()
        const store = useStore()

        const projectId = route.params.id
        onBeforeMount(() => {
            const data = store.dispatch('getProject', projectId)
        }) 

        const project = computed(() => store.getters['project'])

        return {
            project
        }
    }
}
</script>
<style lang="">
    
</style>