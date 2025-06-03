<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'VOLGASHOT' }}</title>
  <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style type="text/tailwindcss">
    @theme {
    --font-inter: "Inter", "sans-serif"; 

    --breakpoint-2xl: 1600px;
    --breakpoint-xl: 1280px;
    --breakpoint-lg: 1024px;
    --breakpoint-md: 768px;
    --breakpoint-sm: 640px;
    --breakpoint-xs: 400px;
    --breakpoint-xxs: 320px;

    --color-background: #0E0D13;
    --color-action: #121117;
    --color-border: #191919;
    }

    .tab {
        margin-top: 20px;
    }

    .tab-content {
        display: none;
    }

    #tab-btn-1:checked ~ .tab-container #content-1,
    #tab-btn-2:checked ~ .tab-container #content-2 {
        display: block;
    }

    .tab > input[type="radio"] {
        display: none;
    }

    .tab > input[type="radio"]:checked + label {
    color: #434190;
    }

    html {
        scroll-behavior: smooth;
    }
  </style>
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