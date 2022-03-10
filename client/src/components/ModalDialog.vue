<template lang="">
    <transition name="fade">
        <div
        v-if="showModal"
        id="modal-project"
        class="fixed inset-0 w-full h-screen flex items-center justify-center bg-semi-75 bg-gray-100  "
        style="background: rgba(0, 0, 0, 0.75); "
        @click.self="close" >
            <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-8 relative ">
                <button
                    id="projectModalClose"
                    aria-label="close"
                    class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4" 
                    @click.prevent="close"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <slot />
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    name: 'ProjectModal',
    props: {
        showModal: {
            required: true,
            type: Boolean
        },

    },
    methods: {
        close() {
            this.$emit('close');
        }
    },
    watch: {
        showing(value) {
            if (value) {
                return document.querySelector('body').classList.add('overflow-hidden');
            }

            document.querySelector('body').classList.remove('overflow-hidden');
        }
    }
    
}
</script>
<style scoped>

    
</style>