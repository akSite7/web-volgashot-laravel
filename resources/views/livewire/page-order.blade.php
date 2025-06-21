<!-- Секция и контейнер -->
<section class="w-full">
  <div class="container mx-auto px-8 py-15">

    <!-- Контент -->
    <h1 class="font-semibold text-2xl sm:text-3xl mb-6 sm:mb-10 ml-2 sm:ml-5">Оформление заказа</h1>
    <form wire:submit.prevent='placeOrder'>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Контактная информация -->
        <div class="bg-action border border-border p-6 rounded shadow lg:col-span-2">
          <h2 class="text-xl sm:text-2xl font-semibold mb-4 xs:text-left xxs:text-center">Контактная информация</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
            <input wire:model='first_name' type="text" placeholder="Имя" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent sm:text-left xxs:text-center" />
            <input wire:model='last_name' type="text" placeholder="Фамилия" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent sm:text-left xxs:text-center" />
            <input wire:model='phone' type="text" placeholder="Номер телефона" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent sm:col-span-2 sm:text-left  xxs:text-center" />
          </div>
          <h3 class="text-xl sm:text-2xl font-semibold mb-4  xs:text-left xxs:text-center">Данные для доставки</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <input wire:model='city' type="text" placeholder="Город" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent sm:text-left xxs:text-center" />
            <input wire:model='address' type="text" placeholder="Адрес" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent sm:text-left xxs:text-center" />
            <input wire:model='notes' type="text" placeholder="Комментарий" class="w-full sm:col-span-2 bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent sm:text-left xxs:text-center" />
          </div>
        </div>

        <!-- Итог -->
        <div class="bg-action border border-border rounded-lg p-6 w-full flex flex-col h-full">
          <h2 class="text-xl sm:text-2xl font-semibold mb-4">Итого</h2>
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
          </div>
          <div class="flex-grow"></div>
          <div class="border-t pt-5 mt-4 flex justify-between font-semibold text-sm">
            <span>Итого</span>
            <span>{{ number_format($total_price, 0, '.', ' ') }} ₽ / {{ $total_quantity }} кг</span>
          </div>
          <button type="submit" class="cursor-pointer mt-4 w-full py-2 rounded bg-accent hover:bg-accent-hover disabled:bg-gray-400 disabled:cursor-not-allowed" @disabled(!$cart_items)>
            Оформить заказ
          </button>
        </div>

        <!-- Корзина -->
        <div class="bg-action border border-border rounded-lg p-4 xl:p-4 w-full col-span-1 lg:col-span-3 overflow-x-auto">
          <!-- Верхний блок корзины -->
          <ul class="hidden xl:grid grid-cols-6 border-b pb-4 text-sm font-medium text-gray-400">
            <li class="col-span-2">Товар</li>
            <li>Цена за 1кг</li>
            <li class="ml-1">Итого</li>
            <li class="ml-2">Килограмм</li>
            <li class="ml-5">Удаление</li>
          </ul>
          <!-- Товарный блок корзины -->
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
            <div class="flex items-center justify-center h-48 text-gray-400 text-lg col-span-6 xs:text-left xxs:text-center">
              Добавьте товары в корзину
            </div>
          @endforelse
        </div>
      </div>
    </form>
    <!-- Конец контента -->
    
  </div>
</section>
<!-- Конец секции и контейнера -->