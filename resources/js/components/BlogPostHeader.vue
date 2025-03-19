<script setup lang="ts">
import { UserCircleIcon, CalendarIcon, HeartIcon, ClockIcon, EyeIcon } from '@heroicons/vue/24/outline'

defineProps({
  title: String,
  tags: Array,
  author: String,
  publishedDate: String,
  likesCount: Number,
  readingTime: Number,
  viewCount: Number
})
</script>

<template>
  <header class="max-w-4xl mx-auto text-center mb-12">
    <div v-if="tags.length" class="flex flex-wrap justify-center gap-2 mb-6">
      <span
        v-for="tag in tags"
        :key="tag.id"
        class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium bg-ca-primary/10 text-ca-primary"
      >
        {{ tag.name }}
      </span>
    </div>

    <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 dark:text-white mb-6 leading-tight">
      {{ title }}
    </h1>

    <div class="flex flex-wrap items-center justify-center gap-6 text-gray-600 dark:text-gray-400">
      <div class="flex items-center">
        <UserCircleIcon class="h-5 w-5 mr-2"/>
        <span>{{ author }}</span>
      </div>

      <div class="flex items-center">
        <CalendarIcon class="h-5 w-5 mr-2"/>
        <span>{{ publishedDate }}</span>
      </div>

      <div class="flex items-center">
        <HeartIcon class="h-5 w-5 mr-2"/>
        <span>{{ likesCount }} {{ likesCount === 1 ? 'Like' : 'Likes' }}</span>
      </div>

      <div class="flex items-center">
        <ClockIcon class="h-5 w-5 mr-2"/>
        <span>{{ readingTime }} min read</span>
      </div>

      <div class="flex items-center">
        <EyeIcon class="h-5 w-5 mr-2"/>
        <span>{{ viewCount }} views</span>
      </div>
    </div>
  </header>
</template>
