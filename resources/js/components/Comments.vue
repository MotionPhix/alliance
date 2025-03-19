<script setup lang="ts">
import { ref, computed } from 'vue'
import { PaperAirplaneIcon, TrashIcon } from '@heroicons/vue/24/outline'
import axios from 'axios'
import { formatDistanceToNow } from 'date-fns'

const props = defineProps({
  postSlug: String,
  initialComments: Array
})

const comments = ref(props.initialComments)
const newComment = ref('')
const isSubmitting = ref(false)

const sortedComments = computed(() => {
  return [...comments.value].sort((a, b) =>
    new Date(b.created_at) - new Date(a.created_at)
  )
})

const formatDate = (date) => {
  return formatDistanceToNow(new Date(date), { addSuffix: true })
}

const submitComment = async () => {
  if (!newComment.value.trim()) return

  isSubmitting.value = true

  try {
    const { data } = await axios.post(`/api/posts/${props.postSlug}/comments`, {
      content: newComment.value
    })
    comments.value.unshift(data)
    newComment.value = ''
    emit('comment-added')
  } catch (error) {
    if (error.response?.status === 401) {
      window.location.href = '/login'
    }
  } finally {
    isSubmitting.value = false
  }
}

const deleteComment = async (commentId) => {
  if (!confirm('Are you sure you want to delete this comment?')) return

  try {
    await axios.delete(`/api/comments/${commentId}`)
    comments.value = comments.value.filter(comment => comment.id !== commentId)
    emit('comment-deleted')
  } catch (error) {
    console.error('Error deleting comment:', error)
  }
}

const emit = defineEmits(['comment-added', 'comment-deleted'])
</script>

<template>
  <section class="mt-12">
    <h2 class="text-2xl font-display font-bold text-gray-900 dark:text-white mb-8">
      Comments ({{ comments.length }})
    </h2>

    <!-- Comment Form -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 mb-8">
      <form @submit.prevent="submitComment">
        <textarea
          v-model="newComment"
          rows="4"
          class="w-full p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-ca-primary focus:border-transparent transition duration-200 ease-in-out"
          placeholder="Share your thoughts..."
        ></textarea>

        <div class="mt-4 flex justify-end">
          <button
            type="submit"
            :disabled="isSubmitting"
            class="inline-flex items-center px-6 py-3 bg-ca-primary text-white rounded-xl hover:bg-ca-highlight transition-colors duration-300 disabled:opacity-50"
          >
            <PaperAirplaneIcon class="h-5 w-5 mr-2"/>
            {{ isSubmitting ? 'Posting...' : 'Post Comment' }}
          </button>
        </div>
      </form>
    </div>

    <!-- Comments List -->
    <TransitionGroup
      name="comment-list"
      tag="div"
      class="space-y-6"
    >
      <div
        v-for="comment in sortedComments"
        :key="comment.id"
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6"
      >
        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0">
            <div class="w-12 h-12 rounded-full bg-ca-primary/10 flex items-center justify-center">
              <span class="text-ca-primary font-semibold text-lg">
                {{ comment.user.name.charAt(0) }}
              </span>
            </div>
          </div>
          <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-2">
              <div>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">
                  {{ comment.user.name }}
                </h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                  {{ formatDate(comment.created_at) }}
                </p>
              </div>
              <button
                v-if="comment.can_delete"
                @click="deleteComment(comment.id)"
                class="text-red-600 hover:text-red-800 dark:hover:text-red-400 transition-colors duration-300"
              >
                <TrashIcon class="h-5 w-5"/>
              </button>
            </div>
            <p class="text-gray-700 dark:text-gray-300">
              {{ comment.content }}
            </p>
          </div>
        </div>
      </div>
    </TransitionGroup>
  </section>
</template>

<style scoped>
.comment-list-enter-active,
.comment-list-leave-active {
  transition: all 0.3s ease;
}
.comment-list-enter-from,
.comment-list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}
</style>
