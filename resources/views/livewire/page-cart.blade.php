<!-- Секция и контейнер -->
<section class="w-full">
  <div class="container mx-auto px-8 py-15">
    
    <!-- Контент -->
    <h1 class="text-2xl md:text-3xl font-semibold mb-6 xl:mb-10 ml-2 xl:ml-5">Корзина товаров</h1>
    <div class="flex flex-col xl:flex-row gap-5">

      <!-- Корзина с товарами -->
      <div class="bg-action border border-border rounded-lg p-4 xl:p-4 w-full xl:w-3/4">
        <ul class="hidden xl:grid grid-cols-6 border-b pb-4 text-sm font-medium text-gray-400">
          <li class="col-span-2">Товар</li>
          <li>Цена за 1кг</li>
          <li class="ml-1">Итого</li>
          <li class="ml-2">Килограмм</li>
          <li class="ml-5">Удаление</li>
        </ul>
        @forelse ($cart_items as $item)
          <div wire:key="{{ $item['product_id'] }}" class="grid xl:grid-cols-6 grid-cols-1 items-center gap-4 py-4 border-b xl:border-none">
            <div class="col-span-2 flex items-center gap-4">
              <img class="w-20 h-20 object-cover rounded-md" src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" />
              <div class="text-base">{{ $item['name'] }}</div>
            </div>
            <div class="md:text-left text-sm md:mt-0 mt-2">
              <span class="xl:hidden font-medium text-gray-500">Цена за 1кг:</span>
              {{ number_format($item['unit_amount'], 0, '.', ' ') }} ₽
            </div>
            <div class="md:text-left text-sm md:mt-0 mt-2">
              <span class="xl:hidden font-medium text-gray-500">Итого:</span>
              {{ number_format($item['total_amount'], 0, '.', ' ') }} ₽
            </div>
            <div class="flex items-center gap-3 md:mt-0 mt-2">
              <button wire:click='decreasedQty({{ $item["product_id"] }})' class="px-3 cursor-pointer bg-indigo-600 text-white text-lg rounded hover:bg-indigo-700">-</button>
              <span>{{ $item["quantity"] }} кг</span>
              <button wire:click='increasedQty({{ $item["product_id"] }})' class="px-3 cursor-pointer bg-indigo-600 text-white text-lg rounded hover:bg-indigo-700">+</button>
            </div>
            <div class="xl:justify-start xxs:flex xxs:justify-end md:mt-0 mt-2">
              <button wire:click="removeItem({{ $item['product_id'] }})" wire:loading.attr="disabled" class="px-3 cursor-pointer py-1 bg-red-500 text-white rounded hover:bg-red-600 disabled:bg-gray-400 md:ml-2 xxs:ml-5">
                <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">Удалить</span>
                <span wire:loading wire:target="removeItem({{ $item['product_id'] }})">Удаление...</span>
              </button>
            </div>
          </div>
        @empty
          <div class="flex items-center justify-center h-48 text-gray-400 text-lg col-span-6">
            Добавьте товары в корзину
          </div>
        @endforelse
      </div>

      <!-- Блок итогов -->
      <div class="bg-action border border-border rounded-lg p-6 w-full xl:w-1/4 self-start">
        <h2 class="text-xl md:text-2xl font-semibold mb-4">Итого</h2>
        <div class="space-y-2 text-sm">
          <div class="flex justify-between">
            <span>Цена товаров</span>
            <span class="text-gray-400">{{ number_format($total_price, 0, '.', ' ') }} ₽</span>
          </div>
          <div class="flex justify-between">
            <span>Товара в кг</span>
            <span class="text-gray-400">{{ $total_quantity }} кг</span>
          </div>
          <div class="flex justify-between pb-3">
            <span>Цена доставки</span>
            <span class="text-gray-400">Индивидуальная</span>
          </div>
          <div class="border-t pt-5 mt-4 flex justify-between font-semibold">
            <span>Итого</span>
            <span>{{ number_format($total_price, 0, '.', ' ') }} ₽ / {{ $total_quantity }} кг</span>
          </div>
        </div>
        <a href="{{ $cart_items ? '/cart/order' : '#' }}" class="block text-center mt-5 w-full py-2 rounded text-white {{ $cart_items ? 'bg-accent hover:bg-accent-hover cursor-pointer' : 'bg-gray-500 pointer-events-none' }} 2xl:text-base xl:text-sm">
          Перейти к оформлению заказа
        </a>
      </div>
    </div>
    <!-- Конец контента -->

  </div>
</section>
<!-- Конец секции и контейнера -->