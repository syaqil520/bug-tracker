<template lang="">
    <div>
        {{ state.test }}
        <button class="bg-blue-400 text-center py-0 mt-4" @click="change">change</button>
    </div>
</template>
<script>
import api from '@/api/config'
import { reactive } from '@vue/reactivity'
export default {
    name: 'Test',
    setup() {
        
        const state = reactive({
            test: 'hello',
        })

        function change() {
            state.test = 'new'
        }

        return {
            state,
            change
        }
    }
}
</script>
<style lang="">
    
</style>