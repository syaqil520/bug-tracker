<template>
  <teleport to="body">
    <transition
      enter-active-class="transition ease-out duration-200 transform"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition ease-in duration-200 transform"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        ref="modal-backdrop"
        class="fixed z-10 inset-0 overflow-y-auto bg-black bg-opacity-50"
        v-show="showModal"
      >
        <div
          class="flex items-start justify-center min-h-screen pt-24 text-center"
        >
          <transition
            enter-active-class="transition ease-out duration-300 transform "
            enter-from-class="opacity-0 translate-y-10 scale-95"
            enter-to-class="opacity-100 translate-y-0 scale-100"
            leave-active-class="ease-in duration-200"
            leave-from-class="opacity-100 translate-y-0 scale-100"
            leave-to-class="opacity-0 translate-y-10 translate-y-0 scale-95"
          >
            <div
              class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl p-8 w-1/2"
              role="dialog"
              ref="modal"
              aria-modal="true"
              v-show="showModal"
              aria-labelledby="modal-headline"
            >
              <button @click="closeModal" class="absolute top-4 right-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </button>
              <slot>I'm empty inside!</slot>
            </div>
          </transition>
        </div>
      </div>
    </transition>
  </teleport>
</template>

<script>
import { ref, watch } from 'vue'
import useClickOutside from '../composables/useClickOutside'

const props = {
  show: {
    type: Boolean,
    default: false,
  },
};
export default {
  name: 'ModalDialog',
  props,
  emits: ['close'],
  setup(props, context) {
    const showModal = ref(false);
    const modal = ref(null);
    const { onClickOutside } = useClickOutside();
    function closeModal() {
      context.emit('close');
    }
    onClickOutside(modal, () => {
      if (showModal.value === true) {
        closeModal();
      }
    });
    watch(
      () => props.show,
      show => {
        showModal.value = show;
      },
    );
    return {
      closeModal,
      showModal,
      modal,
    };
  },
};
</script>

<style></style>