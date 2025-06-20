<header class="w-full py-6">
  <div class="container px-8 mx-auto flex gap-10 items-center justify-between">

    <!-- Обертка -->
    <div class="flex gap-10">

      <!-- Лого -->
      <a href="{{ route('page.home') }}" class="text-gray-400">VOLGASHOT</a>

      <!-- Навигация -->
      <nav class="md:inline xxs:hidden">
        <ul class="flex gap-5">
          <li>
            <a href="/category/fraction" class="hover:text-accent-hover">Дробь</a>
          </li>
          <li>
            <a href="/category/buckshot" class="hover:text-accent-hover">Картечь</a>
          </li>
          <li>
            <a href="/contact" class="hover:text-accent-hover">Контакты</a>
          </li>
        </ul>
      </nav>
    </div>
    
    <!-- Маркетплейсы -->
    <ul class="flex gap-5 md:flex xxs:hidden">

      <li>
        <a target="blank" href="https://www.ozon.ru/seller/volgashot-2290576/" class="px-4 py-2 text-center border rounded border-border bg-action">Ozon</a>
      </li>
      <li>
        <a target="blank" href="https://www.wildberries.ru/seller/4306216#c287942850" class="px-4 py-2 text-center border rounded border-border bg-action">Wildberries</a>
      </li>
    </ul>

    <!-- Обертка бургер-меню -->
    <div class="relative md:hidden">
      <input type="checkbox" id="menu-toggle" class="peer hidden" />

      <!-- Кнопка бургер-меню -->
      <div class="">
        <label for="menu-toggle" class="cursor-pointer pt-4 pb-1 px-2 rounded bg-action border border-border">
          <i class='bxr bx-menu-wider text-2xl'></i>
        </label>
      </div>

      <!-- Блок бургер-меню -->
      <nav class="absolute top-12 right-0 w-145 p-4 hidden peer-checked:block z-50 rounded bg-action border border-border md:peer-checked:hidden sm:w-145 xs:w-85 xxs:w-65">
        <ul class="flex flex-col gap-2">
          <li>
            <a href="/" class="{{ request()->is('/') ? 'bg-accent' : '' }} block px-4 py-2 rounded text-white">Главная</a>
          </li>
          <li>
            <a href="/category/fraction" class="{{ request()->is('category/fraction') ? 'bg-accent' : '' }} block px-4 py-2 rounded text-white">Дробь</a>
          </li>
          <li>
            <a href="/category/buckshot" class="{{ request()->is('category/buckshot') ? 'bg-accent' : '' }} block px-4 py-2 rounded">Картечь</a>
          </li>
          <li>
            <a href="/contact" class="{{ request()->is('contact') ? 'bg-accent' : '' }} block px-4 py-2 rounded">Контакты</a>
          </li>
        </ul>
      </nav>
      
    </div>

  </div>
</header>