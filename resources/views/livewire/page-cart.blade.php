<section class="w-full">
  <div class="container mx-auto px-8 py-15">

  
    <h1 class="text-3xl font-semibold mb-10 ml-5">Корзина товаров</h1>
    <div class="flex flex-row gap-5">

      <!-- Корзина с товарами -->
      <div class="bg-action border border-border rounded-lg p-7 w-3/4">
        <ul class="grid grid-cols-6 border-b pb-4 text-sm font-medium text-gray-400">
          <li class="col-span-2">Товар</li>
          <li>Цена за 1кг</li>
          <li class="ml-1">Итого</li>
          <li class="ml-2">Килограмм</li>
          <li class="ml-3">Удаление</li>
        </ul>
        @forelse ($cart_items as $item)
          <div wire:key="{{ $item['product_id'] }}" class="grid grid-cols-6 items-center gap-4 pt-5">
            <div class="col-span-2 flex items-center gap-5">
              <img class="w-20 h-20" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}" />
              <div>{{ $item['name'] }}</div>
            </div>
            <div>{{ number_format($item['unit_amount'], 0, '.', ' ') }} ₽</div>
            <div>{{ number_format($item['total_amount'], 0, '.', ' ') }} ₽</div>
            <div class="flex items-center gap-5">
              <button wire:click='decreasedQty({{ $item["product_id"] }})' class="px-3 bg-indigo-600 text-2xl rounded cursor-pointer hover:bg-indigo-700">-</button>
              <span>{{ $item["quantity"] }} кг</span>
              <button wire:click='increasedQty({{ $item["product_id"] }})' class="px-2 bg-indigo-600 text-2xl rounded cursor-pointer hover:bg-indigo-700">+</button>
            </div>
            <div>
              <button wire:click="removeItem({{ $item['product_id'] }})" wire:loading.attr="disabled" wire:target="removeItem({{ $item['product_id'] }})" class=" px-3 py-1 cursor-pointer bg-indigo-600 hover:bg-indigo-700 disabled:bg-gray-500 disabled:cursor-not-allowed rounded">
                <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">
                  Удалить
                </span>
                <span wire:loading wire:target="removeItem({{ $item['product_id'] }})">
                  Удаление...
                </span>
              </button>
            </div>
          </div>
        @empty
          <div class="flex items-center justify-center h-48 text-gray-400 text-lg col-span-6">
            Добавьте товары в корзину
          </div>
        @endforelse
      </div>

      <!-- Блок итоговых значений -->
      <div class="bg-action border border-border rounded-lg p-6 w-1/4 self-start">
        <h2 class="text-2xl font-semibold mb-4">Итого</h2>
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
          <div class="border-t pt-7 mt-2 flex justify-between font-semibold">
            <span>Итого</span>
            <span>{{ number_format($total_price, 0, '.', ' ') }} ₽ / {{ $total_quantity }} кг</span>
          </div>
        </div>
        <a href="{{ $cart_items ? '/cart/order' : '#' }}" class="block text-center mt-3 w-full py-2 rounded {{ $cart_items ? 'bg-accent hover:bg-accent-hover cursor-pointer' : 'bg-gray-500 pointer-events-none' }}">
          Перейти к оформлению заказа
        </a>
      </div>
    </div>

  </div>
</section>

