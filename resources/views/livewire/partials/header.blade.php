<header class="w-full py-6">
  <div class="container px-8 mx-auto flex items-center justify-between">
    <div class="flex items-center gap-10">
      <a class="text-gray-400" wire:navigate href="{{ route('page.home') }}">
        VOLGASHOT
      </a>
      <nav>
        <menu class="flex items-center gap-5">
          <li>
            <a wire:navigate href="/category/fraction" class="hover:text-indigo-600">Дробь</a>
          </li>
          <li>
            <a wire:navigate href="/category/buckshot" class="hover:text-indigo-600">Картечь</a>
          </li>
          <li>
            <a wire:navigate href="/contact" class="hover:text-indigo-600">Контакты</a>
          </li>
        </menu>
      </nav>
    </div>
    <div class="flex gap-5">
      <a target="blank" href="https://www.ozon.ru/seller/volgashot-2290576/" class="px-4 py-2 text-center border rounded border-border bg-action">
        Ozon
      </a>
      <a target="blank" href="https://www.wildberries.ru/seller/4306216#c287942850" class="px-4 py-2 text-center border rounded border-border bg-action">
        Wildberries
      </a>
    </div>
  </div>
</header>