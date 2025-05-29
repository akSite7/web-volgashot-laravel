<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'VOLGASHOT' }}</title>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  @vite('resources/css/app.css')
  @livewireStyles
</head>
<body class="bg-background text-white font-inter flex flex-col h-screen">
  <livewire:partials.header />
    <main class="flex-grow">
       {{ $slot }}
    </main>
  <livewire:partials.footer />
  @livewireScripts
</body>
</html>