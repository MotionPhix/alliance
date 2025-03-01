<div>
  <input
    type="text"
    x-data="{
      tags: @js($tags),
      selectedTags: @entangle($this->getStatePath()),
      addTag(tag) {
        if (!this.selectedTags.includes(tag)) {
          this.selectedTags.push(tag);
        }
      },
      removeTag(tag) {
        this.selectedTags = this.selectedTags.filter(t => t !== tag);
      }
    }"
    x-init="selectedTags = selectedTags || []"
    x-on:keydown.enter.prevent="addTag($event.target.value); $event.target.value = ''"
    class="w-full p-2 border rounded-lg"
    placeholder="Add a tag...">

  <!-- Display selected tags -->
  <div class="mt-2 flex flex-wrap gap-2">
    <template x-for="tag in selectedTags" :key="tag">
      <div class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm flex items-center">
        <span x-text="tag"></span>
        <button
          type="button"
          @click="removeTag(tag)" class="ml-2">
          &times;
        </button>
      </div>
    </template>
  </div>
</div>
