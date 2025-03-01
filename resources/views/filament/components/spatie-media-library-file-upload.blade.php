<div>
  <input
    type="file"
    x-data="{
        files: [],
        addFile(file) {
            this.files.push(file);
        },
        removeFile(file) {
            this.files = this.files.filter(f => f !== file);
        }
    }"
    x-on:change="addFile($event.target.files[0])"
    class="w-full p-2 border rounded-lg">
  <div class="mt-2 flex flex-wrap gap-2">
    <template x-for="file in files" :key="file.name">
      <div class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm flex items-center">
        <span x-text="file.name"></span>
        <button type="button" @click="removeFile(file)" class="ml-2">
          &times;
        </button>
      </div>
    </template>
  </div>
</div>
