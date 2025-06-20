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
          @php
            $item = collect($cart_items)->firstWhere('product_id', $product->id);
          @endphp
          <li>
            <article>
              <img class="rounded-md" src="{{ url('storage', $product->image) }}" alt="Изображение товара">
              <h1 class="pt-3 sm:text-2xl xxs:text-lg">{{ $product->name }}</h1>
              <p class="pt-2 text-gray-400 sm:text-sm xxs:text-xs">{{ $product->description }}</p>
              <p class="text-xl text-gray-400 pb-5 pt-2">
                  {{ $product->price }} ₽<span class="text-sm text-gray-400"> за 1кг</span>
              </p>
              @if ($item)
                    <div class="flex items-center gap-3">
                      <button
                        wire:click="decreasedQty({{ $product->id }})"
                        class="px-4 py-1 bg-accent text-xl rounded-lg hover:bg-accent-hover transition">
                        –
                      </button>
                      <span class="text-lg">{{ $item['quantity'] }} кг</span>
                      <button
                        wire:click="increasedQty({{ $product->id }})"
                        class="px-4 py-1 bg-accent text-xl rounded-lg hover:bg-accent-hover transition">
                        +
                      </button>
                    </div>
                  @else
                    <a
                      wire:click.prevent='addToCart({{ $product->id }})'
                      class="inline-block px-4 py-2 rounded-lg font-medium border cursor-pointer border-border bg-accent hover:bg-accent-hover transition">
                      Добавить в корзину
                    </a>
                  @endif
            </article>
          </li>
        @endforeach
      </ul>
    </div>
  </div>









<section class="w-full pb-24" id="assortment">
  <div class="container px-8 mx-auto">
    <span class="inline-flex p-2 text-sm rounded border border-border bg-action">🛒 Наш ассортимент</span>
      <div class="flex gap-4 mt-4">
        <input type="radio" name="tab" id="tab-fraction" class="cursor-pointer mr-2" checked>
        <label for="tab-fraction">Дробь</label>
        /
        <input type="radio" name="tab" id="tab-buckshot" class="cursor-pointer ml-2">
        <label for="tab-buckshot">Картечь</label>
      </div>
      <div class="xl:mt-5 xl:ml-10 xxs:ml-0">
        <!-- <h1 class="pt-8 font-medium sm:text-6xl xxs:text-4xl">{{ $category->name }}</h1>
        <h2 class="text-gray-500 pt-8 xl:pt-8 sm:text-lg xxs:text-sm xxs:pt-4">{!! $category->description !!}</h2> -->
        <div class="grid pt-8 gap-y-14 gap-8 xl:grid-cols-4 lg:grid-cols-3 xxs:grid-cols-2">
          <!-- Категория Дробь -->
          <div class="tab-content" id="fraction">
            @foreach ($categories->firstWhere('category_slug', 'fraction')?->products ?? [] as $product)
              <article>
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
              </article>
            @endforeach
          </div>
          <div class="tab-content" id="buckshot">
            @foreach ($categories->firstWhere('category_slug', 'buckshot')?->products ?? [] as $product)
              <article>
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
              </article>
            @endforeach
          </div>
        </div>
      </div>
      


  </div>
</section>













<div class="assortment-section">
  <div class="container">
    <h2>🛒 Наш ассортимент</h2>

    <!-- Radio buttons -->
    <input type="radio" name="tab" id="tab-fraction" checked>
    <label for="tab-fraction">Дробь</label>

    <input type="radio" name="tab" id="tab-buckshot">
    <label for="tab-buckshot">Картечь</label>

    <!-- Категория Дробь -->
    <div class="tab-content" id="fraction">
      @foreach ($categories->firstWhere('category_slug', 'fraction')?->products ?? [] as $product)
        <article>
          <h3>{{ $product->name }}</h3>
          <p>{{ $product->description }}</p>
        </article>
      @endforeach
    </div>

    <!-- Категория Картечь -->
    <div class="tab-content" id="buckshot">
      @foreach ($categories->firstWhere('category_slug', 'buckshot')?->products ?? [] as $product)
        <article>
          <h3>{{ $product->name }}</h3>
          <p>{{ $product->description }}</p>
        </article>
      @endforeach
    </div>
  </div>
</div>

<style>
  /* Layout */
  .assortment-section {
    padding: 20px;
  }

  .container {
    max-width: 900px;
    margin: auto;
  }

  /* Hide radio buttons */
  input[type="radio"] {
    display: none;
  }

  /* Labels as tabs */
  label {
    display: inline-block;
    padding: 10px 20px;
    margin-right: 5px;
    background: #eee;
    cursor: pointer;
    border-radius: 5px 5px 0 0;
  }

  input[type="radio"]:checked + label {
    background: #ccc;
    font-weight: bold;
  }

  /* Tab contents */
  .tab-content {
    display: none;
    padding: 20px;
    border: 1px solid #ccc;
    border-top: none;
  }

  #tab-fraction:checked ~ #fraction,
  #tab-buckshot:checked ~ #buckshot {
    display: block;
  }
</style>






























  
</section>



