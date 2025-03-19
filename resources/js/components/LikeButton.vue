<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'

const props = defineProps({
  postId: {
    type: Number,
    required: true
  },
  initialLiked: {
    type: Boolean,
    default: false
  },
  initialCount: {
    type: Number,
    default: 0
  }
})

const liked = ref(props.initialLiked)
const count = ref(props.initialCount)
const loading = ref(false)

const toggleLike = async () => {
  if (loading.value) return

  loading.value = true

  try {
    const { data } = await axios.post(route('api.toggle-like', props.postId))
    liked.value = data.liked
    count.value = data.count
  } catch (error) {
    console.error('Error toggling like:', error)
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="flex items-center space-x-2">
    <button
      @click="toggleLike"
      :disabled="loading"
      :class="[
        'flex items-center gap-4 space-x-1 px-3 py-1 rounded-full transition-colors',
        {
          'bg-primary-100 text-primary-600': liked,
          'hover:bg-gray-100 dark:hover:bg-gray-800': !liked,
          'opacity-50 cursor-not-allowed': loading
        }
      ]">
      <svg
        :class="[
          'w-5 h-5 transition-transform',
          { 'scale-125 fill-primary-600': liked }
        ]"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
        />
      </svg>
      <span class="text-sm font-medium">{{ count }}</span>
    </button>
  </div>
</template>
