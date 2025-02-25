@props(['member'])

<div class="bg-white rounded-lg shadow-lg overflow-hidden hover-card">
  <div class="aspect-w-4 aspect-h-3">
    <img
      src="{{ asset($member['image']) }}"
       alt="{{ $member['name'] }}"
       class="w-full h-full object-cover">
  </div>

  <div class="p-6">
    <h3 class="text-xl font-semibold mb-2">{{ $member['name'] }}</h3>
    <p class="text-blue-600 mb-4">{{ $member['position'] }}</p>
    <p class="text-gray-600 mb-4">{{ $member['bio'] }}</p>
    <div class="flex space-x-4">
      <x-social-icons :links="$member['social']" />
    </div>
  </div>
</div>
