<section class="w-full pb-24" id="assortment">
  <div class="container px-8 mx-auto">
    <span class="inline-flex p-2 text-sm rounded border border-border bg-action">🛒 Наш ассортимент</span>
    <div class="flex gap-4 mt-4">
      <button wire:click="changeCategory('fraction')" class="{{ $category->category_slug === 'fraction' ? 'text-[#434190]' : '' }} cursor-pointer mr-2">
        Дробь
      </button>
      /
      <button wire:click="changeCategory('buckshot')" class="{{ $category->category_slug === 'buckshot' ? 'text-[#434190]' : '' }} cursor-pointer ml-2">
        Картечь
      </button>
    </div>
    <div class="xl:mt-5 xl:ml-10 xxs:ml-0">
      <h1 class="pt-8 font-medium sm:text-6xl xxs:text-4xl">{{ $category->name }}</h1>
      <div class="text-gray-500 pt-8 xl:pt-8 sm:text-lg xxs:text-sm xxs:pt-4">{!! $category->description !!}</div>
      <ul class="grid pt-8 gap-y-14 gap-8 xl:grid-cols-4 lg:grid-cols-3 xxs:grid-cols-2">
        @foreach ($products as $product)
          <li>
            <article>
              <img class="rounded-md" src="{{ url('storage', $product->image) }}" alt="Изображение товара">
              <h1 class="pt-3 sm:text-2xl xxs:text-lg">{{ $product->name }}</h1>
              <p class="pt-2 text-gray-400 sm:text-sm xxs:text-xs">{{ $product->description }}</p>
              <p class="text-xl text-gray-400 pb-5 pt-2">
                  {{ $product->price }} ₽<span class="text-sm text-gray-400"> за 1кг</span>
              </p>
              <a href="#feedback" class="px-4 pb-2 pt-2 rounded font-medium border border-border bg-indigo-600">Заказать</a>
            </article>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</section>