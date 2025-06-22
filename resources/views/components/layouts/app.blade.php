<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @unless (request()->is('/'))
      <meta name="robots" content="noindex, nofollow">
  @endunless
  <!-- Основные данные -->
  <title>{{ $title ?? 'VOLGASHOT - Продажа охотничьей дроби и картечи от производителя' }}</title>
  <meta name="description" content="Специализированный онлайн магазин, который предлагает ассортимент охотничьей дроби и картечи от производителя высокого качества для охотников, спортсменов и любителей стрелкового дела. На нашем сайте вы найдете разнообразные виды дроби и картечи. Мы гарантируем только оригинальную продукцию, которая отличается надежностью, точностью и безопасностью использования. Доверьтесь опыту и надежности VOLGASHOT и наслаждайтесь покупками без лишних хлопот!">
  <meta name="keywords" content="дробь, картечь, дробь охотничья, картечь охотничья, дробь свинцовая, картечь свинцовая, дробь от производителя, картечь от производителя, VOLGASHOT">
  <meta name="author" content="VOLGASHOT">

  <!-- Прочее -->
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="theme-color" content="#ffffff">
  <meta name="apple-mobile-web-app-title" content="VOLGASHOT">

  <!-- FavIcons -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}?v=4">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=4">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('icons/favicon-96x96.png') }}?v=4">
  <link rel="icon" type="image/svg+xml" href="{{ asset('icons/favicon.svg') }}?v=4">
  <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}?v=4">

  <!-- Иконки BoxIcons -->
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  
  <!-- AlpineJs -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- Стили и подключение Tailwind -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
    --color-accent: #4f39f6;
    --color-accent-hover: #432dd7;
    --color-action: #121117;
    --color-border: #191919;
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