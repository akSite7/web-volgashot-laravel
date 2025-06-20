<section class="w-full pb-24" id="assortment">
  <div class="container px-8 mx-auto">
    <span class="inline-flex p-2 mb-5 text-sm rounded border border-border bg-action">🛒 Наш ассортимент</span>
    <div>
      <input type="radio" name="tab" id="tab-fraction" checked>
      <label for="tab-fraction" class="cursor-pointer mr-3">Дробь</label>
      /
      <input type="radio" name="tab" id="tab-buckshot">
      <label for="tab-buckshot" class="cursor-pointer ml-3">Картечь</label>
      <div class="tab-content xl:mt-5 xl:ml-10 xxs:ml-0" id="fraction">
        @php
          $fractionCategory = $categories->firstWhere('category_slug', 'fraction');
        @endphp
        @if($fractionCategory)
          <h1 class="pt-8 font-medium sm:text-6xl xxs:text-4xl">{{ $fractionCategory->name }}</h1>
          <div class="text-gray-500 pt-8 xl:pt-8 sm:text-lg xxs:text-sm xxs:pt-4">{!! $fractionCategory->description !!}</div>
        @endif
        <ul class="grid pt-8 gap-y-14 gap-8 xl:grid-cols-4 lg:grid-cols-3 xxs:grid-cols-2" >
          @foreach ($categories->firstWhere('category_slug', 'fraction')?->products ?? [] as $product)
            @php
              $item = collect($cart_items)->firstWhere('product_id', $product->id);
            @endphp
             <li>
              <article >
                <img class="rounded-md" src="{{ url('storage', $product->image) }}" alt="Изображение товара">
                <h1 class="pt-3 sm:text-2xl xxs:text-lg">{{ $product->name }}</h1>
                <p class="pt-2 text-gray-400 sm:text-sm xxs:text-xs">{{ $product->description }}</p>
                <p class="text-xl text-gray-400 pb-5 pt-2">
                    {{ $product->price }} ₽<span class="text-sm text-gray-400"> за 1кг</span>
                </p>
                @if ($item)
                  <div class="flex items-center gap-2">
                    <button wire:click="decreasedQty({{ $product->id }})" class="w-10 h-10 cursor-pointer bg-accent text-xl hover:bg-accent-hover rounded-lg hover:bg-accent-hover sm:w-10 sm:h-10 xxs:w-9 xxs:h-8">
                      –
                    </button>
                    <span class="sm:text-xl xxs:text-sm">{{ $item['quantity'] }} кг</span>
                    <button wire:click="increasedQty({{ $product->id }})" class="w-10 h-10 cursor-pointer bg-accent text-xl hover:bg-accent-hover rounded-lg hover:bg-accent-hover sm:w-10 sm:h-10 xxs:w-9 xxs:h-8">
                      +
                    </button>
                  </div>
                @else
                  <a
                    wire:click.prevent='addToCart({{ $product->id }})'
                    class="inline-block px-4 py-2 rounded-lg font-medium border cursor-pointer border-border bg-accent hover:bg-accent-hover sm:text-base xxs:text-sm">
                    В корзину
                  </a>
                @endif
              </article>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="tab-content xl:mt-5 xl:ml-10 xxs:ml-0" id="buckshot">
        @php
          $buckshotCategory = $categories->firstWhere('category_slug', 'buckshot');
        @endphp
        @if($buckshotCategory)
          <h1 class="pt-8 font-medium sm:text-6xl xxs:text-4xl">{{ $buckshotCategory->name }}</h1>
          <div class="text-gray-500 pt-8 xl:pt-8 sm:text-lg xxs:text-sm xxs:pt-4">{!! $buckshotCategory->description !!}</div>
        @endif
        <ul class="grid pt-8 gap-y-14 gap-8 xl:grid-cols-4 lg:grid-cols-3 xxs:grid-cols-2" >
          @foreach ($categories->firstWhere('category_slug', 'buckshot')?->products ?? [] as $product)
            @php
              $item = collect($cart_items)->firstWhere('product_id', $product->id);
            @endphp
             <li>
              <article >
                <img class="rounded-md" src="{{ url('storage', $product->image) }}" alt="Изображение товара">
                <h1 class="pt-3 sm:text-2xl xxs:text-lg">{{ $product->name }}</h1>
                <p class="pt-2 text-gray-400 sm:text-sm xxs:text-xs">{{ $product->description }}</p>
                <p class="text-xl text-gray-400 pb-5 pt-2">
                    {{ $product->price }} ₽<span class="text-sm text-gray-400"> за 1кг</span>
                </p>
                @if ($item)
                  <div class="flex items-center gap-2">
                    <button wire:click="decreasedQty({{ $product->id }})" class="w-10 h-10 cursor-pointer bg-accent text-xl hover:bg-accent-hover rounded-lg hover:bg-accent-hover sm:w-10 sm:h-10 xxs:w-9 xxs:h-8">
                      –
                    </button>
                    <span class="sm:text-xl xxs:text-sm">{{ $item['quantity'] }} кг</span>
                    <button wire:click="increasedQty({{ $product->id }})" class="w-10 h-10 cursor-pointer bg-accent text-xl hover:bg-accent-hover rounded-lg hover:bg-accent-hover sm:w-10 sm:h-10 xxs:w-9 xxs:h-8">
                      +
                    </button>
                  </div>
                @else
                  <a wire:click.prevent='addToCart({{ $product->id }})' class="inline-block px-4 py-2 rounded-lg font-medium border cursor-pointer border-border bg-accent hover:bg-accent-hover sm:text-base xxs:text-sm">
                    В корзину
                  </a>
                @endif
              </article>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  <style>
    #tab-fraction:checked + label,
    #tab-buckshot:checked + label {
      color: #434190;
    }

    input[type="radio"] {
      display: none;
    }

    .tab-content {
      display: none;

    }

    #tab-fraction:checked ~ #fraction,
    #tab-buckshot:checked ~ #buckshot {
      display: block;
    }
  </style>
</section>



