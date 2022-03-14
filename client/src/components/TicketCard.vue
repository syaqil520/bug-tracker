<template lang="">
    <div>
        <div class="flex justify-between mb-1">
            <p class="text-lg font-semibold tracking-wide">Tickets</p>
            <button class="btn-success py-1 " @click="openAddModal">New Ticket</button>
        </div>
        <div>
            <ticket-list></ticket-list>            
        </div>

        <general-modal :show="showAddModal" @close="closeAddModal">
            <div>
                <h2 class="modal-title">Add New Ticket</h2>
                <form @submit.prevent="createTicket">
                    <div>
                        <label class="text-gray-700" >Title</label>
                        <input type="text" class="basic-input" v-model="tempTicket.title" >
                    </div>
                    <div>
                        <label class="text-gray-700" >Description</label>
                        <input type="text" class="basic-input" v-model="tempTicket.description">
                    </div>  
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label class="text-gray-700">Priority</label>
                            <select class="basic-select" aria-label="Default select example" v-model="tempTicket.priority" >
                                <option value="0" selected>High</option>
                                <option value="1">Medium</option>
                                <option value="2">low</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-gray-700">Status</label>
                            <select class="basic-select" aria-label="Default select example" v-model="tempTicket.status">
                                <option value="0" selected>New</option>
                                <option value="1">In Progress</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-gray-700">Tag</label>
                            <select class="basic-select" aria-label="Default select example" v-model="tempTicket.tag">
                                <option value="Issue" selected>Issue</option>
                                <option value="Feature Request">Feature Request</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn-primary" >Create</button>
                    </div>
                    
                    
                </form>
            </div>
        </general-modal>

    </div>
</template>
<script>
import GeneralModalVue from './GeneralModal.vue'
import { reactive, ref, toRaw } from 'vue'
import { useStore } from 'vuex'
import { useRoute } from 'vue-router'
import api from '@/api/ticketApi'
import TicketListTableVue from './TicketListTable.vue'

export default {
    components: {
        'general-modal': GeneralModalVue,
        'ticket-list': TicketListTableVue
    }, 
    setup() {
        const store = useStore()
        const route = useRoute()

        const showAddModal = ref(false) 

        function closeAddModal() {
            showAddModal.value = false
            tempTicket.title = ''
            tempTicket.description = ''
            tempTicket.priority = 0
            tempTicket.status = 0
            tempTicket.tag = 'Issue'
        }

        function openAddModal() {
            showAddModal.value = true
        }
        
        const tempTicket = reactive({
            title: '',
            description: '',
            priority: 0,
            status: 0,
            tag: 'Issue'
        })

        async function createTicket() {
            const { data } = await api.storeTicket(route.params.id, tempTicket)
            if(data.success) {
                store.dispatch('getTickets', route.params.id)
                closeAddModal()
            }
        }

        return {
            showAddModal,
            closeAddModal,
            openAddModal,
            tempTicket,
            createTicket
        }
    }
    
}
</script>
<style lang="">
    
</style>