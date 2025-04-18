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
  <meta property="og:image" content="{{ asset('images/og-image.webp') }}">
  <meta property="og:url" content="{{ url()->current() }}">

  <!-- Twitter Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $title ?? 'Welcome' }} | Citizen Alliance">
  <meta name="twitter:description"
        content="{{ $description ?? 'Citizen Alliance (CA) is a coalition of civil society organizations and citizen groups.' }}">
  <meta name="twitter:image" content="{{ asset('images/og-twitter.webp') }}">

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

  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="{{ asset('manifest.json') }}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.bunny.net/css?family=dm-serif-display:400" rel="stylesheet" />

  <script>
    window.sessionSuccess = @json(session('success'));
    window.sessionError = @json(session('error'));
  </script>

  <!-- routes -->
  @routes
  @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="font-poppins antialiased bg-white dark:bg-gray-900">
  <div class="min-h-screen" id="blog_app">
    @include('components.header')

    <main>
      {{ $slot }}
    </main>

    @include('components.footer')
  </div>

  <!-- Toast Notifications -->
  <div id="toast-container" class="fixed bottom-4 right-4 z-50"></div>

  <!-- Scripts -->
  @stack('scripts')
</body>
</html>
