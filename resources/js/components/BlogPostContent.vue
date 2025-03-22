<template>
  <div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-8 md:p-12">
      <div
        class="prose dark:prose-invert prose-lg max-w-none"
        v-html="content"
      ></div>

      <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
        <like-button
          :post-id="postId"
          :initial-liked="initialLiked"
          :initial-count="likesCount"
          @like-updated="$emit('like-updated', $event)"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  content: {
    type: String,
    required: true
  },
  postId: {
    type: Number,
    required: true
  },
  initialLiked: {
    type: Boolean,
    default: false
  },
  likesCount: {
    type: Number,
    default: 0
  }
})
</script>
