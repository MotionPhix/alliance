<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { CheckCircleIcon, XCircleIcon } from '@heroicons/vue/24/outline'

const toasts = ref([])

const addToast = (message, isError = false) => {
  const id = Date.now()
  toasts.value.push({ id, message, isError })
  setTimeout(() => {
    toasts.value = toasts.value.filter(toast => toast.id !== id)
  }, 3000)
}

onMounted(() => {
  if (window.sessionSuccess) {
    addToast(window.sessionSuccess)
  }
  if (window.sessionError) {
    addToast(window.sessionError, true)
  }
})

defineExpose({ addToast })
</script>

<template>
  <TransitionGroup
    tag="div"
    class="fixed bottom-4 right-4 z-50 space-y-2"
    name="toast"
  >
    <div
      v-for="toast in toasts"
      :key="toast.id"
      class="flex items-center space-x-2 px-6 py-4 rounded-xl shadow-lg"
      :class="toast.isError ? 'bg-red-500' : 'bg-green-500'"
    >
      <div class="flex-shrink-0 text-white">
        <CheckCircleIcon
          v-if="!toast.isError"
          class="h-5 w-5"
        />
        <XCircleIcon
          v-else
          class="h-5 w-5"
        />
      </div>
      <p class="text-white font-medium">{{ toast.message }}</p>
    </div>
  </TransitionGroup>
</template>

<style scoped>
.toast-enter-active,
.toast-leave-active {
  transition: all 0.3s ease;
}
.toast-enter-from,
.toast-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>
