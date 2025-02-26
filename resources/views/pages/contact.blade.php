<x-app-layout>
  <x-slot name="title">Contact Us</x-slot>
  <x-slot name="description">
    Get in touch with Citizen Alliance for inquiries, collaborations, or support.
  </x-slot>

  <!-- Hero Section -->
  <section class="relative">
    <div
      class="relative w-full h-[400px] overflow-hidden bg-blue-600 bg-[url('https://preline.co/assets/svg/examples/abstract-1.svg')] bg-no-repeat bg-cover bg-center p-4 rounded-lg text-center">
      <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-black/70"></div>
      
      <div class="absolute inset-0 flex items-center">
        <div class="container mx-auto px-4 text-center">
          <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">Contact Us</h1>
          <p class="text-xl md:text-2xl text-white max-w-2xl mx-auto">
            We’d love to hear from you! Reach out for inquiries, collaborations, or support.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Information Section -->
  <x-content-container class="py-16">
    <h2 class="text-3xl font-bold text-center mb-8">Get in Touch</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Address -->
      <div class="text-center">
        <div class="w-16 h-16 bg-blue-600 text-white rounded-lg flex items-center justify-center mx-auto mb-6">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Address</h3>
        <p class="text-gray-600">Area 47/2/113, Lilongwe Street, P.O. Box 619, Lilongwe, Malawi</p>
      </div>

      <!-- Phone -->
      <div class="text-center">
        <div class="w-16 h-16 bg-blue-600 text-white rounded-lg flex items-center justify-center mx-auto mb-6">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Phone</h3>
        <p class="text-gray-600">+265 (0) 991 602 233</p>
      </div>

      <!-- Email -->
      <div class="text-center">
        <div class="w-16 h-16 bg-blue-600 text-white rounded-lg flex items-center justify-center mx-auto mb-6">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Email</h3>
        <p class="text-gray-600">citizenalliance12@gmail.com</p>
      </div>
    </div>
  </x-content-container>

  <!-- Contact Form Section -->
  <div class="bg-gray-50">
    <x-content-container class="py-16">
      <h2 class="text-3xl font-bold text-center mb-8">Send Us a Message</h2>
      <form class="max-w-2xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>
        </div>
        <div class="mt-6">
          <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
          <input type="text" id="subject" name="subject" required
                 class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        <div class="mt-6">
          <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
          <textarea id="message" name="message" rows="5" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
        </div>
        <div class="mt-6">
          <button type="submit"
                  class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
            Send Message
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
          </button>
        </div>
      </form>
    </x-content-container>
  </div>

  <!-- Map Section -->
  <div class="w-full h-[400px]">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3880.123456789012!2d33.774123!3d-13.987654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDU5JzE1LjYiUyAzM8KwNDYnMjYuOCJF!5e0!3m2!1sen!2smw!4v1234567890123!5m2!1sen!2smw"
      width="100%"
      height="100%"
      style="border:0;"
      allowfullscreen=""
      loading="lazy">
    </iframe>
  </div>

  <!-- Call to Action Section -->
  <section class="py-16 bg-blue-600 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-10"></div>
    <div class="container mx-auto px-4 relative">
      <div class="text-center max-w-3xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Partner With Us</h2>
        <p class="text-xl mb-8">
          Join us in our mission to empower citizens and drive sustainable development in Malawi.
        </p>
        <a href="{{ route('contact') }}"
           class="inline-flex items-center px-8 py-3 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-300">
          Get in Touch
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </a>
      </div>
    </div>
  </section>
</x-app-layout>
