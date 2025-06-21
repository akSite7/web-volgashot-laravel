<div>
  
  <!-- Секция и контейнер -->
  <section class="w-full">
    <div class="container mx-auto px-8 py-15">

      <!-- Контент -->
      <div class="mb-20">
        <div>
          <h1 class=" font-medium text-5xl">{{ $category->name }}</h1>
          <div class="text-lg  text-gray-500 pt-8">{!! $category->description !!}</div>
          <ul class="grid pt-8 gap-y-14 gap-8 xl:grid-cols-4 lg:grid-cols-3 xxs:grid-cols-2">
            @foreach ($products as $product)
              @php
                $item = collect($cart_items)->firstWhere('product_id', $product->id);
              @endphp
              <li>
                <article>
                  <img class="rounded-md" src="{{ asset('storage/' . $product->image) }}" alt="Изображение товара">
                  <h1 class="pt-3 text-2xl">{{ $product->name }}</h1>
                  <p class="pt-2 text-gray-400 text-sm">{{ $product->description }}</p>
                  <p class="text-xl text-gray-400 pb-5 pt-2">{{ $product->price }} ₽<span class="text-sm text-gray-400"> за 1кг</span></p>
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
      <!-- Конец контента -->

    </div>
  </section>
  <!-- Конец секции и контейнера -->

  <!-- Подключенные блоки -->
  @livewire('ui.feedback-form')
  @livewire('ui.cart-button')

</div>