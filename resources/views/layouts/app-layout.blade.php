<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description"
        content="{{ $description ?? 'Citizen Alliance (CA) is a coalition of civil society organizations and citizen groups established in 2012' }}">

  <title>{{ $title ?? 'Citizen Alliance' }} | {{ config('app.name') }}</title>

  <!-- Social Media Meta Tags -->
  <meta property="og:title" content="{{ $title ?? 'Citizen Alliance' }}">
  <meta property="og:description"
        content="{{ $description ?? 'Citizen Alliance (CA) is a coalition of civil society organizations and citizen groups' }}">
  <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
  <meta property="og:url" content="{{ url()->current() }}">

  <!-- Twitter Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $title ?? 'Welcome' }} | Citizen Alliance">
  <meta name="twitter:description"
        content="{{ $description ?? 'Citizen Alliance (CA) is a coalition of civil society organizations and citizen groups.' }}">
  <meta name="twitter:image" content="{{ asset('img/og-image.jpg') }}">

  <!-- Structured Data -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NGO",
      "name": "Citizen Alliance",
      "url": "https://citizenalliancemw.org",
      "logo": "{{ asset('images/logo.png') }}",
      "description": "Non-profit organization focused on community empowerment and sustainable development",
      "foundingDate": "2015",
      "founder": {
        "@type": "Organization",
        "name": "Citizen Alliance Founders"
      }
    }
  </script>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.bunny.net/css?family=dm-serif-display:400" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css'])
</head>
<body class="font-poppins antialiased bg-white dark:bg-gray-900">
<div class="min-h-screen">
  @include('components.header')

  <main>
    {{ $slot }}
  </main>

  @include('components.footer')
</div>

<!-- Toast Notifications -->
<div id="toast-container" class="fixed bottom-4 right-4 z-50"></div>

@vite(['resources/js/app.js'])
@stack('scripts')
</body>
</html>
